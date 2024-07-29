<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\RespUe;
use App\Entity\Teacher;
use App\Entity\UE;
use App\Repository\ECRepository;
use App\Repository\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
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


    #[Route('/teacheresdashboard', name: 'respue_dashboard')]
    public function teacherEcDashboard(
        TeacherRepository $teacherRepository,
        ECRepository $ecRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
    
        // Récupérer l'UE du RespUE connecté
        $ue = $user->getRespue()->getUe();
    
        if (!$ue instanceof UE) {
            throw $this->createNotFoundException('Aucune UE associée à ce RespUE.');
        }
    
        // Récupérer les ECs pour cette UE
        $ecs = $ecRepository->findBy(['ue' => $ue]);
    
        // Récupérer les IDs des ECs
        $ecIds = array_map(function ($ec) {
            return $ec->getId();
        }, $ecs);
    
        // Récupérer tous les enseignants associés à ces ECs
        $teachersWithEcs = $teacherRepository->createQueryBuilder('t')
            ->join('t.ecs', 'ec')
            ->where('ec.id IN (:ecIds)')
            ->setParameter('ecIds', $ecIds)
            ->getQuery()
            ->getResult();
    
        // Récupérer tous les enseignants créés par ce RespUE
        $allTeachers = $teacherRepository->findBy(['created_by' => $user]);
    
        // Identifier les enseignants sans EC
        $teachersWithoutEcs = array_filter($allTeachers, function($teacher) use ($teachersWithEcs) {
            return !in_array($teacher, $teachersWithEcs);
        });
    
        // Fusionner les deux listes d'enseignants
        $teachers = array_merge($teachersWithEcs, $teachersWithoutEcs);
    
        // Préparer les données pour la vue
        $ecData = [];
        $teacherData = [];
        $totalEcs = count($ecs);
        $totalTeachers = count($teachers);
    
        foreach ($ecs as $ec) {
            $ecData[] = [
                'id' => $ec->getId(),
                'name' => $ec->getName(),
                'teacher' => $ec->getTeacher() ? $ec->getTeacher()->getName() : 'Non assigné',
            ];
        }
    
        foreach ($teachers as $teacher) {
            $teacherEcs = $teacher->getEcs()->filter(function ($ec) use ($ue) {
                return $ec->getUe() === $ue;
            });
    
            $ecCount = $teacherEcs->count();
    
            $teacherData[] = [
                'id' => $teacher->getId(),
                'name' => $teacher->getName(),
                'email' => $teacher->getEmail(),
                'phoneNumber' => $teacher->getPhoneNumber(),
                'ecCount' => $ecCount,
                'ecs' => $teacherEcs->map(function ($ec) {
                    return $ec->getName();
                })->toArray(),
            ];
        }
    
        // Trier les enseignants par nombre d'ECs (décroissant)
        usort($teacherData, function ($a, $b) {
            return $b['ecCount'] - $a['ecCount'];
        });
    
        // Calculer les statistiques
        $averageEcsPerTeacher = $totalTeachers > 0 ? $totalEcs / $totalTeachers : 0;
    
        return $this->render('admin_dashboard/respue_dashboard.html.twig', [
            'ecData' => $ecData,
            'teacherData' => $teacherData,
            'teacherCount' => $totalTeachers,
            'ecCount' => $totalEcs,
            'averageEcsPerTeacher' => round($averageEcsPerTeacher, 2),
            'user' => $user,
            'ue' => $ue
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_teacher', methods: ['POST'])]
    public function deleteTeacher(EntityManagerInterface $entityManager, int $id): Response
    {
        // Récupérer l'enseignant par son identifiant
        $teacher = $entityManager->getRepository(Teacher::class)->find($id);

        if (!$teacher) {
            $this->addFlash('error', 'Enseignant non trouvé.');
            return $this->redirectToRoute('respue_dashboard');
        }

        try {
            $entityManager->beginTransaction();

            // Dissocier l'enseignant de toutes les ECs où il est associé
            $ecs = $entityManager->getRepository(EC::class)->findBy(['teacher' => $teacher]);
            foreach ($ecs as $ec) {
                $ec->setTeacher(null);
                $entityManager->persist($ec);
            }

            // Supprimer l'utilisateur associé s'il existe
            $user = $teacher->getUser();
            if ($user) {
                $entityManager->remove($user);
            }

            // Supprimer l'enseignant lui-même
            $entityManager->remove($teacher);

            $entityManager->flush();
            $entityManager->commit();

            $this->addFlash('success', 'Enseignant supprimé avec succès.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'Une erreur est survenue lors de la suppression de l\'enseignant : ' . $e->getMessage());
        }

        return $this->redirectToRoute('respue_dashboard');
    }





}
