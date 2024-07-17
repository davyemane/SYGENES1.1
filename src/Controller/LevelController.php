<?php

namespace App\Controller;

use App\Entity\Level;
use App\Form\LevelType;
use App\Repository\LevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminlevel')]
class LevelController extends AbstractController
{
    #[Route('/new_level/{id?0}', name: 'level_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, LevelRepository $levelRepository, Security $security, int $id = 0): Response
    {
        // Récupérer l'école de la session
        $session = $request->getSession();
        $schoolName = $session->get('school_name');
    
        if (!$schoolName) {
            throw $this->createNotFoundException('Aucune école trouvée dans la session');
        }
    
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();
    
        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour créer un niveau.');
        }
    
        // Récupérer la filière de l'utilisateur connecté
        $field = $user->getRespfield()->getField();
    
        if (!$field) {
            throw $this->createNotFoundException('Aucune filière trouvée pour l\'utilisateur connecté.');
        }
    
        if ($id > 0) {
            $level = $entityManager->getRepository(Level::class)->find($id);
            if (!$level) {
                throw $this->createNotFoundException('Niveau non trouvé');
            }
        } else {
            $level = new Level();
        }
    
        // Passer la filière de l'utilisateur au formulaire
        $form = $this->createForm(LevelType::class, $level, ['school_name' => $schoolName, 'user_field' => $field]);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$level->getId()) {
                $entityManager->persist($level);
            }
            $entityManager->flush();
    
            $this->addFlash('success', $id > 0 ? 'Le niveau a été mis à jour avec succès.' : 'Le niveau a été créé avec succès.');
            return $this->redirectToRoute('level_new');
        }
    
        // Récupérer tous les niveaux existants pour l'école en session
        $existingLevels = $entityManager->getRepository(Level::class)
            ->createQueryBuilder('l')
            ->join('l.field', 'f')
            ->join('f.school', 's')
            ->where('s.name = :schoolName')
            ->andWhere('f = :userField')
            ->setParameter('schoolName', $schoolName)
            ->setParameter('userField', $field)
            ->getQuery()
            ->getResult();
    
        return $this->render('level/new.html.twig', [
            'level' => $level,
            'form' => $form->createView(),
            'isNew' => $id === 0,
            'existingLevels' => $existingLevels,
            'schoolName' => $schoolName // Passer le nom de l'école à la vue
        ]);
    }
        

    #[Route('/delete_level/{id}', name: 'delete_level')]
    public function deleteLevel(Level $level, EntityManagerInterface $entityManager): Response
    {
        try {
            $entityManager->beginTransaction();

            // Remove associations with Students
            foreach ($level->getStudents() as $student) {
                $student->setLevel(null);
            }

            // Remove associations with UEs
            foreach ($level->getUes() as $ue) {
                $ue->setLevel(null);
            }

            // Remove associations with Fields
            foreach ($level->getField() as $field) {
                $level->removeField($field);
            }

            // Set the main Field to null
            $level->setField(null);

            // Remove the Level
            $entityManager->remove($level);

            // Apply changes
            $entityManager->flush();
            $entityManager->commit();

            $this->addFlash('success', 'The level has been successfully deleted.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'An error occurred during deletion: ' . $e->getMessage());
        }

        return $this->redirectToRoute('admin_level_dashboard');
    }
}
