<?php

namespace App\Controller;

use App\Entity\Level;
use App\Form\LevelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/level')]
class LevelController extends AbstractController
{
    #[Route('/', name: 'app_level')]
    public function index(): Response
    {
        return $this->render('level/index.html.twig', [
            'controller_name' => 'LevelController',
        ]);
    }

    #[Route('/new/{id?0}', name: 'level_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id = 0): Response
    {
        if ($id > 0) {
            $level = $entityManager->getRepository(Level::class)->find($id);
            if (!$level) {
                throw $this->createNotFoundException('Filière non trouvée');
            }
        } else {
            $level = new Level();
        }
        
        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$level->getId()) {
                $entityManager->persist($level);
            }
            $entityManager->flush();
    
            $this->addFlash('success', $id > 0 ? 'Le niveau a été mis à jour avec succès.' : 'Le niveau a été créé avec succès.');
            return $this->redirectToRoute('level_new');
        }
    
        return $this->render('level/new.html.twig', [
            'level' => $level,
            'form' => $form->createView(),
            'isNew' => $id === 0
        ]);
    }
}
