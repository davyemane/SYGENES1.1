<?php

namespace App\Controller;

use App\Entity\Field;
use App\Entity\School;
use App\Form\FieldType;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/new/{id?0}', name: 'field_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, int $id = 0): Response
    {
        $schoolName = $session->get('school_name');
        $school = null;
    
        if ($schoolName) {
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
            if (!$school) {
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
    }}