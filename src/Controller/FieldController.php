<?php

namespace App\Controller;

use App\Entity\Field;
use App\Entity\School;
use App\Entity\User;
use App\Form\FieldType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class FieldController extends AbstractController
{
    #[Route('/field', name: 'app_field')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $fields = $entityManager->getRepository(Field::class)->findAll();
        return $this->render('field/index.html.twig', [
            'fields' => $fields,
        ]);
    }

    #[Route('/new_field/{id?0}', name: 'field_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, int $id = 0): Response
    {
        $schoolName = $session->get('school_name');
        $school = null;
    
        if ($schoolName) {
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
            if (!$school) {
                return $this->redirectToRoute('app_login');
                throw $this->createNotFoundException('École non trouvée');
            }
        } else {
            throw $this->createNotFoundException('Aucune école sélectionnée');
        }
    
        if ($id > 0) {
            $field = $entityManager->getRepository(Field::class)->find($id);
            if (!$field) {
                throw $this->createNotFoundException('Filière non trouvée');
            }
        } else {
            $field = new Field();
        }
        
        $form = $this->createForm(FieldType::class, $field);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $field->setSchool($school); // Assurez-vous que l'école est toujours définie avant la persistance
            if (!$field->getId()) {
                $entityManager->persist($field);
            }
            $entityManager->flush();
    
            $this->addFlash('success', $id > 0 ? 'La filière a été mise à jour avec succès.' : 'La filière a été créée avec succès.');
            return $this->redirectToRoute('field_new');
        }
    
        // Récupérer les filières existantes pour cette école
        $existingFields = $entityManager->getRepository(Field::class)->findBy(['school' => $school]);
        $colorScheme = [
            'primaryColor' => '#3490dc', // Bleu vif pour la couleur principale
            'secondaryColor' => '#ffed4a', // Jaune doré pour la couleur secondaire
            'accentColor' => '#e3342f', // Rouge vif pour les accents
            'backgroundColor' => '#f8fafc', // Blanc cassé pour l'arrière-plan
            'textColor' => '#2d3748' // Gris foncé pour le texte
        ];


        return $this->render('field/new.html.twig', [
            'field' => $field,
            'form' => $form,
            'isNew' => $id === 0,
            'school' => $school,
            'existingFields' => $existingFields,
            'color_scheme'=>$colorScheme,
        ]);
    }


    #[Route('/delete_field/{id}', name: 'delete_field')]
    public function deleteField(
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        int $id
    ): Response {
        $logger->info('Début de la méthode deleteField', ['field_id' => $id]);
    
        try {
            $user = $this->getUser();
            if (!$user) {
                $logger->warning('Utilisateur non authentifié');
                return $this->redirectToRoute('app_login');
            }
    
            $respSchool = $user->getRespschool();
            if (!$respSchool) {
                $logger->warning('Utilisateur sans droits RespSchool', ['user_id' => $user->getId()]);
                throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour supprimer un Field.');
            }
    
            $field = $entityManager->getRepository(Field::class)->find($id);
            if (!$field) {
                $logger->warning('Field non trouvé', ['field_id' => $id]);
                throw $this->createNotFoundException('Field non trouvé');
            }
    
            if ($field->getSchool() !== $respSchool->getSchool()) {
                $logger->warning('Tentative de suppression d\'un Field non autorisé', ['field_id' => $id, 'user_id' => $user->getId()]);
                throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour supprimer ce Field.');
            }
    
            $logger->info('Début de la suppression du Field', ['field_id' => $id]);
    
            $entityManager->beginTransaction();
    
            $respField = $field->getRespField();
            if ($respField) {
                $userToDelete = $entityManager->getRepository(User::class)->findOneBy(['respfield' => $respField]);
                if ($userToDelete) {
                    $logger->info('Suppression de l\'utilisateur associé', ['user_id' => $userToDelete->getId()]);
                    $entityManager->remove($userToDelete);
                }
                $logger->info('Suppression du RespField', ['respfield_id' => $respField->getId()]);
                $entityManager->remove($respField);
            }
    
            foreach ($field->getUEs() as $ue) {
                $logger->info('Suppression de l\'association UE', ['ue_id' => $ue->getId()]);
                $field->removeUE($ue);
            }
    
            foreach ($field->getLevels() as $level) {
                $logger->info('Suppression du Level', ['level_id' => $level->getId()]);
                $entityManager->remove($level);
            }
    
            foreach ($field->getStudents() as $student) {
                $logger->info('Suppression du Student', ['student_id' => $student->getId()]);
                $entityManager->remove($student);
            }
    
            $logger->info('Suppression du Field', ['field_id' => $id]);
            $entityManager->remove($field);
    
            $entityManager->flush();
            $entityManager->commit();
    
            $this->addFlash('success', sprintf('Le Field "%s", son responsable et le compte utilisateur associé ont été supprimés avec succès !', $field->getName()));
            $logger->info('Field supprimé avec succès', ['field_id' => $id]);
        } catch (\Exception $e) {
            $entityManager->rollback();
            $logger->error('Erreur lors de la suppression du Field', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'field_id' => $id
            ]);
            $this->addFlash('error', 'Une erreur est survenue lors de la suppression du Field : ' . $e->getMessage());
        }
    
        return $this->redirectToRoute('admin_dashboard');
    }
}