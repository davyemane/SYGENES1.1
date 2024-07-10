<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\Field;
use App\Entity\Responsable;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\UE;
use App\Entity\User;
use App\Form\ResponsableType;
use App\Repository\PrivilegeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
class ResponsableController extends AbstractController
{
    #[Route('/resp_statistics', name: 'resp_statistics')]
    public function resp_statistics(): Response
    {
        // Check if the user has ROLE_ADMIN
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'View stitistics') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }


        $user = $this->getUser();
        return $this->render('responsable/resp_statistics.html.twig', [
            'controller_name' => 'ResponsableController',
            'user' => $user
        ]);
    }


    //ajouter un responsable
    #[Route('/add/resp/{id?0}', name: 'add_responsable')]
    public function academicInscription($id, ManagerRegistry $doctrine, Request $request): Response
    {

        // Vérifier si l'utilisateur a le privilège "List Student"
        $user = $this->getUser();
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'Add user') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        $entityManager = $doctrine->getManager();

        // Vérifier si un ID d'étudiant a été fourni
        if ($id) {
            $respo = $entityManager->getRepository(Responsable::class)->find($id);
        } else {
            $respo = new Responsable();
        }

        $form = $this->createForm(ResponsableType::class, $respo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Handle file uploads with try-catch blocks
            try {
                $respo->setCreatedAt(date('d-m-y'));
                $respo->setCreatedBy($this->getUser());
                $entityManager->persist($respo);
                $entityManager->flush();

                $message = $id ? 'mis à jour' : 'ajouté';
                $this->addFlash('success', $respo->getName() . " a été $message avec succès !");

                return $this->redirectToRoute("app_register");
            } catch (\Exception $e) {
                // Handle file upload exceptions (e.g., disk space issues, invalid file types)
                $this->addFlash('error', 'An error occurred while uploading files: ' . $e->getMessage());
                // Consider logging the error for further investigation
            }
        }

        return $this->render('responsable/add.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }



    #[Route("/list/ec/", name: "choix_ec")]
    public function Ec(ManagerRegistry $doctrine): Response
    {
        // Vérifier si l'utilisateur a le privilège "List Student"
        $user = $this->getUser();
        $hasListStudentPrivilege = false;
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
                if ($privilege->getName() === 'List EC') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        $entityManager = $doctrine->getManager();

        // Retrieve all UEs
        $ues = $entityManager->getRepository(UE::class)->findAll();

        // Prepare data for the template
        $data = [];
        foreach ($ues as $ue) {
            // Get ECs associated with the current UE
            $ecs = $ue->getEcs(); // Assuming ManyToMany or OneToMany relationship
            $data[$ue->getName()] = $ecs; // Group ECs by UE name
        }

        return $this->render(
            'ue/listEc.html.twig',
            [
                'data' => $data, 
                'user' => $user,
                'privileges' => array_values($privileges), // Convertir en tableau indexé

            ]
            
        );
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

        // Vérifier si l'utilisateur a le privilège "de valider l'etudiant"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'View Marks') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }


        $hasPrivilege = $entityManager->getRepository(User::class)
            ->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->join('u.role', 'r')
            ->join('r.privileges', 'p')
            ->where('u.id = :userId')
            ->andWhere('p.id = :privilegeId')
            ->setParameter('userId', $user->getId())
            ->setParameter('privilegeId', $privilege->getId())
            ->getQuery()
            ->getSingleScalarResult() > 0;

        if (!$hasPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        // Récupérer l'école de la session
        $session = $request->getSession();
        $schoolName = $session->get('school_name');

        if (!$schoolName) {
            return $this->render('student/error.html.twig', ['message' => 'No school found in session']);
        }

        try {
            $queryBuilder = $entityManager->getRepository(Student::class)
                ->createQueryBuilder('s')
                ->leftJoin('s.notes', 'n')
                ->leftJoin('n.ec', 'ec')
                ->leftJoin('s.field', 'f')
                ->leftJoin('f.school', 'sch')
                ->addSelect('n')
                ->addSelect('ec')
                ->andWhere('sch.name = :schoolName')
                ->setParameter('schoolName', $schoolName);

            // Fetch fields for the specific school
            $fields = $entityManager->getRepository(Field::class)
                ->createQueryBuilder('f')
                ->join('f.school', 's')
                ->where('s.name = :schoolName')
                ->setParameter('schoolName', $schoolName)
                ->getQuery()
                ->getResult();

            // Retrieve search parameters from request
            $fieldId = $request->query->get('field');
            $name = $request->query->get('name');
            $nbre = $request->query->getInt('nbre', 12);
            $page = $request->query->getInt('page', 1);

            // Apply filters if provided
            if ($fieldId) {
                $queryBuilder->andWhere('s.field = :field')
                    ->setParameter('field', $fieldId);
            }
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
                'currentField' => $fieldId,
                'fields' => $fields,
            ]);
        } catch (NotFoundHttpException $e) {
            $this->addFlash('error', 'No students found.');
            return $this->redirectToRoute('list_student_notes', [
                'page' => 1,
                'nbre' => $nbre,
            ]);
        }
    }




    //afficher la listes des filieres 
    #[Route('/fields', name: 'fields_index')]
    public function fields(
        EntityManagerInterface $entityManager,
        RequestStack $requestStack,
        PrivilegeRepository $privilegeRepository
    ): Response {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        // Vérifier si l'utilisateur a le privilège "List Student"
        $user = $this->getUser();
        $hasListStudentPrivilege = false;
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
                if ($privilege->getName() === 'List EC') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        $hasPrivilege = $entityManager->getRepository(User::class)
            ->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->join('u.role', 'r')
            ->join('r.privileges', 'p')
            ->where('u.id = :userId')
            ->andWhere('p.id = :privilegeId')
            ->setParameter('userId', $user->getId())
            ->setParameter('privilegeId', $privilege->getId())
            ->getQuery()
            ->getSingleScalarResult() > 0;

        if (!$hasPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        // Récupération de l'école et des filières associées
        $session = $requestStack->getSession();
        $schoolName = $session->get('school_name');

        if (!$schoolName) {
            return $this->render('student/error.html.twig', ['message' => 'No school found in session']);
        }

        $fields = $entityManager->getRepository(Field::class)
            ->createQueryBuilder('f')
            ->join('f.school', 's')
            ->where('s.name = :schoolName')
            ->setParameter('schoolName', $schoolName)
            ->getQuery()
            ->getResult();

        return $this->render('responsable/field.html.twig', [
            'fields' => $fields,
            'user' => $user,
            'privileges' => array_values($privileges), // Convertir en tableau indexé

        ]);
    }    //list des etudiants en attente de validation d'inscription 

    #[Route('/list_student/{fieldId?1}/{page?1}/{nbre?12}', name: 'list_student_2')]
    public function ListStudent(
        Request $request,
        ManagerRegistry $doctrine,
        EntityManagerInterface $entityManager,
        PrivilegeRepository $privilegeRepository,
        $fieldId = 1,
        $page = 1,
        $nbre = 12
    ): Response {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $user = $this->getUser();
        $hasListStudentPrivilege = false;
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
                if ($privilege->getName() === 'List EC') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        $hasPrivilege = $entityManager->getRepository(User::class)
            ->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->join('u.role', 'r')
            ->join('r.privileges', 'p')
            ->where('u.id = :userId')
            ->andWhere('p.id = :privilegeId')
            ->setParameter('userId', $user->getId())
            ->setParameter('privilegeId', $privilege->getId())
            ->getQuery()
            ->getSingleScalarResult() > 0;

        if (!$hasPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        // Récupérer la session de l'utilisateur
        $session = $request->getSession();
        $schoolName = $session->get('school_name');

        $queryBuilder = $entityManager->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->leftJoin('s.userAccount', 'u')
            ->where('u.id IS NULL');

        if ($schoolName) {
            $queryBuilder
                ->join('s.field', 'f')
                ->join('f.school', 'sch')
                ->andWhere('sch.name = :schoolName')
                ->setParameter('schoolName', $schoolName);
        }

        // Fetch all students initially without filters
        $queryBuilderTotal = clone $queryBuilder;
        $nbStudent = $queryBuilderTotal->select('COUNT(s.id)')->getQuery()->getSingleScalarResult();
        $nbPage = ceil($nbStudent / $nbre);

        // Retrieve search parameters from request
        $name = $request->query->get('name');
        $fieldId = $request->query->get('field', $fieldId);

        // Apply filters if provided
        if ($name) {
            $queryBuilder->andWhere('s.name LIKE :name')->setParameter('name', '%' . $name . '%');
        }
        if ($fieldId) {
            $queryBuilder->andWhere('s.field = :field')->setParameter('field', $fieldId);
        }

        // Fetch filtered students with pagination
        $students = $queryBuilder
            ->setMaxResults($nbre)
            ->setFirstResult(($page - 1) * $nbre)
            ->getQuery()
            ->getResult();

        if (empty($students)) {
            return $this->render('student/error.html.twig', [
                'message' => 'Aucun étudiant trouvé',
                'filters' => ['name' => $name, 'fieldId' => $fieldId],
            ]);
        }

        // Retrieve fields for the specific school
        $fields = [];
        if ($schoolName) {
            $fields = $entityManager->getRepository(Field::class)
                ->createQueryBuilder('f')
                ->join('f.school', 's')
                ->where('s.name = :schoolName')
                ->setParameter('schoolName', $schoolName)
                ->getQuery()
                ->getResult();
        }

        return $this->render('responsable/list_student.html.twig', [
            'students' => $students,
            'isPaginated' => true,
            'nbPage' => $nbPage,
            'page' => $page,
            'nbre' => $nbre,
            'currentName' => $name,
            'currentField' => $fieldId,
            'fields' => $fields,
            'user' => $user,
            'privileges' => array_values($privileges), // Convertir en tableau indexé

        ]);
    }
}
