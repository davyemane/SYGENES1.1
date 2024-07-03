<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\services\SystemNotation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin'), IsGranted('ROLE_TEACHER')]
class NoteController extends AbstractController
{

    #[Route('/add/note/{id?0}', name: 'add_note')]
    public function AddNote($id, ManagerRegistry $doctrine, Request $request, SystemNotation $systemNotation): Response
    {

        // Check if the user has ROLE_ADMIN
        if (!$this->isGranted('ROLE_CEP') ) {
            // Redirect to a custom error page
            return $this->render('student/error.html.twig', [
                'message' => 'Access Denied'
            ], new Response('', Response::HTTP_FORBIDDEN));
        }

        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
    
        // Vérifier si un ID de l'ue a été fourni
        if ($id) {
            $note = $entityManager->getRepository(Note::class)->find($id);
        } else {
            $note = new Note();
        }

        $form = $this->createForm(NoteType::class, $note);
        $users = $this->getUser();
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $note->setCreatedAt(date('d-m-y'));
                $note->setCreatebBy($users);
                $entityManager->persist($note);
                $entityManager->flush();
    
                $message = $id ? 'mis à jour' : 'ajouté';
                $this->addFlash('success', $note->getStudent . " a été $message avec succès !");
    
                return $this->redirectToRoute("app_dashAdmin");
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur s\'est produite.');
                return $this->redirectToRoute('app_dashAdmin');
            }
        }
    
        return $this->render('note/index.html.twig', ['form' => $form->createView(), 
        'user' => $user]);
    }
}
