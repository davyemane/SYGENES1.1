<?php

namespace App\Controller;

use App\Entity\RespUe;
use App\Entity\Student;
use App\Entity\User;
use App\Repository\ECRepository;
use App\Repository\RespUeRepository;
use App\Repository\StudentRepository;
use App\Repository\UERepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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




#[Route('/list/{page<\d+>?1}/{nbre<\d+>?12}', name: 'list_student_notes')]
public function home(
    Request $request,
    EntityManagerInterface $entityManager,
    int $page = 1,
    int $nbre = 12
): Response {
    $user = $this->getUser();
    if (!$user) {
        return $this->redirectToRoute('app_login');
    }

    // Vérifier si l'utilisateur est un RespLevel
    if (!$user->getResplevel()) {
        return $this->render('student/error.html.twig', ['message' => 'Access denied. You must be a RespLevel.']);
    }
    
    $respLevel = $user->getResplevel();
    $level = $respLevel->getLevel();
    $field = $level->getField();

    if (!$field) {
        return $this->render('student/error.html.twig', ['message' => 'No field associated with this level.']);
    }

    try {
        $queryBuilder = $entityManager->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->leftJoin('s.notes', 'n')
            ->leftJoin('n.ec', 'ec')
            ->addSelect('n')
            ->addSelect('ec')
            ->where('s.field = :field')
            ->andWhere('s.level = :level')
            ->setParameter('field', $field)
            ->setParameter('level', $level);

        // Retrieve search parameters from request
        $name = $request->query->get('name');
        $nbre = $request->query->getInt('nbre', 12);
        $page = $request->query->getInt('page', 1);

        // Apply name filter if provided
        if ($name) {
            $queryBuilder->andWhere('s.name LIKE :name')
                ->setParameter('name', '%' . $name . '%');
        }

        // Count total students
        $countQuery = clone $queryBuilder;
        $nbStudent = $countQuery->select('COUNT(DISTINCT s.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Calculate total pages
        $nbPage = ceil($nbStudent / $nbre);

        // Ensure page is within valid limits
        $page = max(1, min($page, $nbPage));

        // Fetch filtered students with pagination
        $students = $queryBuilder
            ->setMaxResults($nbre)
            ->setFirstResult(($page - 1) * $nbre)
            ->getQuery()
            ->getResult();

        if (empty($students)) {
            throw new NotFoundHttpException('No students found.');
        }

        return $this->render('student/list1.html.twig', [
            'user' => $user,
            'students' => $students,
            'isPaginated' => $nbStudent > $nbre,
            'nbPage' => $nbPage,
            'page' => $page,
            'nbre' => $nbre,
            'currentName' => $name,
            'currentField' => $field->getId(),
            'currentLevel' => $level->getId(),
        ]);
    } catch (NotFoundHttpException $e) {
        $this->addFlash('error', 'No students found.');
        return $this->redirectToRoute('ue_dashboards');
    }
}

}
