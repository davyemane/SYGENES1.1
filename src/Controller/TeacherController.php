<?php

namespace App\Controller;

use App\Entity\RespUe;
use App\Entity\UE;
use App\Repository\ECRepository;
use App\Repository\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/adminec')]
class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }


    #[Route('/teacherecdashboard', name: 'respue_dashboard')]
    public function teacherEcDashboard(
        TeacherRepository $teacherRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
    
        if (!$user || !$user->getRespue()) {
            throw $this->createAccessDeniedException('Accès non autorisé.');
        }
    
        // Récupérer l'UE du RespUE connecté
        $ue = $user->getRespue()->getUe();
    
        if (!$ue instanceof UE) {
            throw $this->createNotFoundException('Aucune UE associée à ce RespUE.');
        }
    
        // Récupérer les ECs pour cette UE
        $ecs = $ue->getEcs();
    
        // Récupérer tous les enseignants associés à ces ECs
        $teachers = $entityManager->createQuery(
            'SELECT DISTINCT t, ec FROM App\Entity\Teacher t
             JOIN t.ecs ec
             WHERE ec.ue = :ue'
        )
        ->setParameter('ue', $ue)
        ->getResult();
    
        // Préparer les données pour la vue
        $teacherData = [];
        $totalEcs = 0;
    
        foreach ($teachers as $teacher) {
            $teacherEcs = $teacher->getEcs()->filter(function($ec) use ($ue) {
                return $ec->getUe() === $ue;
            });
            
            $ecCount = $teacherEcs->count();
            $totalEcs += $ecCount;
    
            $teacherData[] = [
                'id' => $teacher->getId(),
                'name' => $teacher->getName(),
                'email' => $teacher->getEmail(),
                'phoneNumber' => $teacher->getPhoneNumber(),
                'ecCount' => $ecCount,
                'ecs' => $teacherEcs->map(function($ec) { return $ec->getName(); })->toArray(),
                'createdAt' => $teacher->getCreatedAt(),
                'createdBy' => $teacher->getCreatedBy() ? $teacher->getCreatedBy()->getUsername() : 'N/A',
            ];
        }
    
        // Trier les enseignants par nombre d'ECs (décroissant)
        usort($teacherData, function($a, $b) {
            return $b['ecCount'] - $a['ecCount'];
        });
    
        // Calculer les statistiques
        $teacherCount = count($teachers);
        $ecCount = $ecs->count();
        $averageEcsPerTeacher = $teacherCount > 0 ? $totalEcs / $teacherCount : 0;
    
        return $this->render('admin_dashboard/respue_dashboard.html.twig', [
            'teacherData' => $teacherData,
            'teacherCount' => $teacherCount,
            'ecCount' => $ecCount,
            'averageEcsPerTeacher' => round($averageEcsPerTeacher, 2),
            'user' => $user,
            'ue' => $ue
        ]);
    }}
