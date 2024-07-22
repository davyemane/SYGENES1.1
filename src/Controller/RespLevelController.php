<?php

namespace App\Controller;

use App\Entity\RespLevel;
use App\Entity\User;
use App\Repository\FieldRepository;
use App\Repository\LevelRepository;
use App\Repository\RespLevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


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


    #[Route('/fielddashboard', name: 'level_dashboard')]
    public function dashboard(
        LevelRepository $levelRepository,
        RespLevelRepository $respLevelRepository,
        FieldRepository $fieldRepository,
        EntityManagerInterface $entityManager
    ): Response {
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

        // Récupérer les statistiques de la filière
        $studentCount = $field->getStudents()->count();
        $ueCount = $field->getUEs()->count();

        // Pour compter les EC, nous devons d'abord récupérer toutes les UE de la filière
        $ecCount = 0;
        foreach ($field->getUEs() as $ue) {
            $ecCount += $ue->getECs()->count();
        }

        // Nombre de niveaux
        $levelCount = $field->getLevels()->count();

        return $this->render('admin_dashboard/level_index.html.twig', [
            'levels' => $levels,
            'resp_levels' => $respLevels,
            'user' => $user,
            'field' => $field,
            'studentCount' => $studentCount,
            'ueCount' => $ueCount,
            'ecCount' => $ecCount,
            'levelCount' => $levelCount
        ]);
    }


    #[Route('/delete_resp_level/{id}', name: 'delete_resp_level')]
    public function deleteRespLevel(RespLevel $respLevel, EntityManagerInterface $entityManager): Response
    {
        // Mettre à jour les utilisateurs qui ont ce RespLevel comme resplevel
        $usersWithRespLevel = $entityManager->getRepository(User::class)->findBy(['resplevel' => $respLevel]);
        foreach ($usersWithRespLevel as $user) {
            $user->setResplevel(null);
        }

        // Mettre à jour l'utilisateur qui a créé ce RespLevel
        $createdBy = $respLevel->getCreatedBy();
        if ($createdBy) {
            $createdBy->removeRespLevel($respLevel);
        }
        // Gérer la relation avec Level
        $level = $respLevel->getLevel();
        if ($level) {
            $level->setRespLevel(null);
        }

        if ($respLevel) {
            // Récupérer l'utilisateur associé au Resplevel
            $userToDelete = $entityManager->getRepository(User::class)->findOneBy(['resplevel' => $respLevel]);
            if ($userToDelete) {
                // Supprimer l'utilisateur
                $entityManager->remove($userToDelete);
            }
        }

        // Supprimer le RespLevel
        $entityManager->remove($respLevel);
        $entityManager->flush();

        $this->addFlash('success', 'Le responsable de niveau a été supprimé avec succès.');

        return $this->redirectToRoute('level_dashboard');
    }







}
