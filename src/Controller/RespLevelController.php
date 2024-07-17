<?php

namespace App\Controller;

use App\Entity\RespLevel;
use App\Repository\FieldRepository;
use App\Repository\LevelRepository;
use App\Repository\RespLevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/adminlevel')]
class RespLevelController extends AbstractController
{
    #[Route('/resp/level', name: 'app_resp_level')]
    public function index(): Response
    {
        return $this->render('resp_level/index.html.twig', [
            'controller_name' => 'RespLevelController',
        ]);
    }


    #[Route('/leveldashboard', name: 'level_dashboard')]
    public function dashboard(
        LevelRepository $levelRepository, 
        RespLevelRepository $respLevelRepository, 
        FieldRepository $fieldRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();
        
        if (!$user || !$user->getRespfield()) {
            throw $this->createAccessDeniedException('Accès non autorisé.');
        }
    
        $respField = $user->getRespfield();
        $fieldId = $respField->getField();
        
        if (!$fieldId) {
            throw $this->createNotFoundException('Aucune filière trouvée pour ce responsable.');
        }
    
        $field = $fieldRepository->find($fieldId);
        
        if (!$field) {
            throw $this->createNotFoundException('La filière associée n\'a pas été trouvée.');
        }
    
        $levels = $field->getLevels();
        $respLevels = [];
    
        foreach ($levels as $level) {
            $respLevel = $respLevelRepository->findOneBy(['level' => $level]);
            if ($respLevel) {
                $respLevels[] = $respLevel;
            }
        }
        
        return $this->render('admin_dashboard/level_index.html.twig', [
            'levels' => $levels,
            'resp_levels' => $respLevels,
            'user' => $user,
            'field' => $field
        ]);
    }
    
    #[Route('/delete_resp_level/{id}', name: 'delete_resp_level')]
    public function deleteRespLevel(RespLevel $respLevel, EntityManagerInterface $entityManager): Response
    {
        try {
            $entityManager->beginTransaction();

            // Remove the association with Level
            $level = $respLevel->getLevel();
            if ($level) {
                $level->setRespLevel(null);
            }

            // Remove the RespLevel
            $entityManager->remove($respLevel);

            // Apply changes
            $entityManager->flush();
            $entityManager->commit();

            $this->addFlash('success', 'The level responsible has been successfully deleted.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'An error occurred during deletion: ' . $e->getMessage());
        }

        return $this->redirectToRoute('admin_level_dashboard');
    }
}
