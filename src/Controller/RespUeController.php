<?php

namespace App\Controller;

use App\Entity\RespUe;
use App\Entity\User;
use App\Repository\ECRepository;
use App\Repository\RespUeRepository;
use App\Repository\StudentRepository;
use App\Repository\UERepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/adminue')]
class RespUeController extends AbstractController
{
    #[Route('/resp/ue', name: 'app_resp_ue')]
    public function index(): Response
    {
        return $this->render('resp_ue/index.html.twig', [
            'controller_name' => 'RespUeController',
        ]);
    }


    #[Route('/leveldashboard', name: 'ue_dashboards')]
    public function dashboard(
        UERepository $ueRepository,
        RespUeRepository $respUERepository,
        StudentRepository $studentRepository,
        ECRepository $ecRepository
    ): Response {
        $user = $this->getUser();

        if (!$user || !$user->getResplevel()) {
            throw $this->createAccessDeniedException('Accès non autorisé.');
        }

        $respLevel = $user->getResplevel();
        $level = $respLevel->getLevel();

        if (!$level) {
            throw $this->createNotFoundException('Aucun niveau trouvé pour ce responsable.');
        }

        $field = $level->getField();

        if (!$field) {
            throw $this->createNotFoundException('La filière associée n\'a pas été trouvée.');
        }

        // Récupérer les UEs du niveau
        $ues = $ueRepository->findBy(['level' => $level]);
        $uesData = [];
        $ecCount = 0;

        foreach ($ues as $ue) {
            $respUE = $respUERepository->findOneBy(['ue' => $ue]);
            $uesData[] = [
                'ue' => $ue,
                'respUE' => $respUE
            ];
            // Count ECs for each UE and add to total
            $ecCount += $ue->getECs()->count();
        }

        // Calculer les statistiques
        $ueCount = count($ues);
        $studentCount = $studentRepository->countByLevel($level);

        return $this->render('admin_dashboard/ue_index.html.twig', [
            'level' => $level,
            'respLevel' => $respLevel,
            'uesData' => $uesData,
            'user' => $user,
            'ueCount' => $ueCount,
            'ecCount' => $ecCount,
            'studentCount' => $studentCount,
        ]);
    }

    #[Route('/delete_resp_ue/{id}', name: 'delete_respue')]
    public function deleteRespUe(RespUe $respUe, EntityManagerInterface $entityManager): Response
    {
        // Gérer la relation avec UE
        $ue = $respUe->getUe();
        if ($ue) {
            $respUe->setUe(null);
            // Si vous avez une relation bidirectionnelle dans UE, vous devrez peut-être ajouter :
            // $ue->setRespUe(null);
        }
    
        // Gérer la relation avec l'utilisateur qui a créé ce RespUe
        $createdBy = $respUe->getCreatedBy();
        if ($createdBy) {
            $createdBy->removeRespUe($respUe);
        }
    
        // Trouver l'utilisateur qui a ce RespUe comme respue et supprimer la relation
        $users = $entityManager->getRepository(User::class)->findBy(['respue' => $respUe]);
        foreach ($users as $user) {
            $user->setRespue(null);
        }
        if ($respUe) {
            // Récupérer l'utilisateur associé au RespUe
            $userToDelete = $entityManager->getRepository(User::class)->findOneBy(['respue' => $respUe]);
            if ($userToDelete) {
                // Supprimer l'utilisateur
                $entityManager->remove($userToDelete);
            }
    
        // Si RespUe a des relations avec d'autres entités, gérez-les ici
        // Par exemple, si RespUe est lié à des EC, vous devriez les mettre à jour
    
        // Supprimer le RespUe
        $entityManager->remove($respUe);
        $entityManager->flush();
    
        $this->addFlash('success', 'Le responsable d\'UE a été supprimé avec succès.');
    
        return $this->redirectToRoute('ue_dashboards'); // Remplacez par la route appropriée
    }
}
}
