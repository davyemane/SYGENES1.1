<?php

namespace App\Controller;

use App\Entity\Field;
use App\Form\FieldType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/field')]
class FieldController extends AbstractController
{
    #[Route('/', name: 'app_field')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $fields = $entityManager->getRepository(Field::class)->findAll();
        return $this->render('field/index.html.twig', [
            'fields' => $fields,
        ]);
    }

    #[Route('/new/{id?0}', name: 'field_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id = 0): Response
    {
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
            if (!$field->getId()) {
                $entityManager->persist($field);
            }
            $entityManager->flush();
    
            $this->addFlash('success', $id > 0 ? 'La filière a été mise à jour avec succès.' : 'La filière a été créée avec succès.');
            return $this->redirectToRoute('field_new');
        }
    
        return $this->render('field/new.html.twig', [
            'field' => $field,
            'form' => $form,
            'isNew' => $id === 0
        ]);
    }
}