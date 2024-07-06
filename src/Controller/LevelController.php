<?php

namespace App\Controller;

use App\Entity\Level;
use App\Form\LevelType;
use App\Repository\LevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    #[Route('/level')]
    class LevelController extends AbstractController
    {
        #[Route('/new/{id?0}', name: 'level_new', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager, LevelRepository $levelRepository, int $id = 0): Response
        {
            // Récupérer l'école de la session
            $session = $request->getSession();
            $schoolName = $session->get('school_name');
    
            if (!$schoolName) {
                throw $this->createNotFoundException('Aucune école trouvée dans la session');
            }
    
            if ($id > 0) {
                $level = $entityManager->getRepository(Level::class)->find($id);
                if (!$level) {
                    throw $this->createNotFoundException('Niveau non trouvé');
                }
            } else {
                $level = new Level();
            }
            
            $form = $this->createForm(LevelType::class, $level, ['school_name' => $schoolName]);
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
                ->join('l.fields', 'f')
                ->join('f.school', 's')
                ->where('s.name = :schoolName')
                ->setParameter('schoolName', $schoolName)
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
    }
