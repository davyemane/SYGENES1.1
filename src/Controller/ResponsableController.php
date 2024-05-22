<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin'), IsGranted('ROLE_ADMIN')]
class ResponsableController extends AbstractController
{
    #[Route('/responsable', name: 'app_responsable')]
    public function index(): Response
    {
        return $this->render('responsable/index.html.twig', [
            'controller_name' => 'ResponsableController',
        ]);
    }


    #[Route('/add/resp/{id?0}', name: 'add_responsable')]
public function academicInscription($id, ManagerRegistry $doctrine, Request $request): Response
{
    $entityManager = $doctrine->getManager();

    // Vérifier si un ID d'étudiant a été fourni
    if ($id) {
        $respo = $entityManager->getRepository(Responsable::class)->find($id);
    } else {
        $respo = new Responsable();
    }

    $form = $this->createForm(ResponsableType::class, $respo);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        // Handle file uploads with try-catch blocks
        try {
            $respo->setCreatedAt(date('d-m-y'));
            $respo->setCreatedBy($this->getUser());
            $entityManager->persist($respo);
            $entityManager->flush();
    
            $message = $id ? 'mis à jour' : 'ajouté';
            $this->addFlash('success', $respo->getName() . " a été $message avec succès !");
    
            return $this->redirectToRoute("app_register");
    

        } catch (\Exception $e) {
            // Handle file upload exceptions (e.g., disk space issues, invalid file types)
            $this->addFlash('error', 'An error occurred while uploading files: ' . $e->getMessage());
            // Consider logging the error for further investigation
        }

    }

    return $this->render('responsable/add.html.twig', ['form' => $form->createView()]);
}

}
