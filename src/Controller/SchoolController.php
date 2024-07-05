<?php

namespace App\Controller;

use App\Entity\School;
use App\Form\SchoolType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/school')]
class SchoolController extends AbstractController
{
    #[Route('/school', name: 'app_school')]
    public function index(): Response
    {
        return $this->render('school/index.html.twig', [
            'controller_name' => 'SchoolController',
        ]);
    }

    #[Route('/new/{id?0}', name: 'school_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, SessionInterface $session, int $id = 0): Response
    {
        if ($id > 0) {
            $school = $entityManager->getRepository(School::class)->find($id);
            if (!$school) {
                throw $this->createNotFoundException('École non trouvée');
            }
        } else {
            $school = new School();
        }
    
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logo')->getData();
    
            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($school->getName());
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();
    
                try {
                    $logoFile->move(
                        $this->getParameter('logo_directory'),
                        $newFilename
                    );
                    $school->setLogo($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors du téléchargement du fichier.');
                    return $this->redirectToRoute('school_new', ['id' => $id]);
                }
            }
    
            if (!$school->getId()) {
                $entityManager->persist($school);
            }
            $entityManager->flush();
            
            // Enregistrez le nom de l'école dans la session
            $session->set('school_name', $school->getName());
    
            $this->addFlash('success', $id > 0 ? 'L\'école a été mise à jour avec succès.' : 'L\'école a été créée avec succès.');
            return $this->redirectToRoute('role_new');
        }
    
        return $this->render('school/new.html.twig', [
            'school' => $school,
            'form' => $form,
            'isNew' => $id === 0
        ]);
    }
}
