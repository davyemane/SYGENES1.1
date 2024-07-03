<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\Field;
use App\Entity\Responsable;
use App\Entity\Student;
use App\Entity\UE;
use App\Entity\User;
use App\Form\ResponsableType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
class ResponsableController extends AbstractController
{
    #[Route ('/resp_statistics', name: 'resp_statistics')]
    public function resp_statistics(): Response{
        // Check if the user has ROLE_ADMIN
        if (!$this->isGranted('ROLE_SA')) {
            // Redirect to a custom error page
            return $this->render('student/error.html.twig', [
                'message' => 'Access Denied'
            ], new Response('', Response::HTTP_FORBIDDEN));
        }

        $user = $this->getUser();
        return $this->render('responsable/resp_statistics.html.twig', [
            'controller_name' => 'ResponsableController',
            'user' => $user
        ]);
    }   

    // #[Route('/responsable', name: 'app_responsable')]
    // public function index(): Response
    // {
    //     $user = $this->getUser();
    //     return $this->render('responsable/index.html.twig', [
    //         'controller_name' => 'ResponsableController',
    //         'user' => $user
    //     ]);
    // }

    
//ajouter un responsable
    #[Route('/add/resp/{id?0}', name: 'add_responsable')]
    public function academicInscription($id, ManagerRegistry $doctrine, Request $request): Response
    {

        // Check if the user has ROLE_ADMIN
        if (!$this->isGranted('ROLE_SA')) {
            // Redirect to a custom error page
            return $this->render('student/error.html.twig', [
                'message' => 'Access Denied'
            ], new Response('', Response::HTTP_FORBIDDEN));
        }

        $user = $this->getUser();
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

        return $this->render('responsable/add.html.twig', ['form' => $form->createView(), 
    'user' => $user]);
    }


    
    #[Route("/list/ec/", name:"choix_ec")]
    public function Ec(ManagerRegistry $doctrine): Response
    {
        // Check if the user has ROLE_ADMIN
        if (!$this->isGranted('ROLE_AATP')) {
            // Redirect to a custom error page
            return $this->render('student/error.html.twig', [
                'message' => 'Access Denied'
            ], new Response('', Response::HTTP_FORBIDDEN));
        }

        $user = $this->getUser();
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
    
        return $this->render('ue/listEc.html.twig', ['data' => $data, 'user' => $user]
        );
    }
    

//liste des etudiants avec leurs notes dans une matiere spécifique 
#[Route('/list', name: 'list_student_notes')]
public function home(Request $request, ManagerRegistry $doctrine): Response
{
    // Check if the user has ROLE_ADMIN
    if (!$this->isGranted('ROLE_AATP')) {
        // Redirect to a custom error page
        return $this->render('student/error.html.twig', [
            'message' => 'Access Denied'
        ], new Response('', Response::HTTP_FORBIDDEN));
    }
    try {
        $repository = $doctrine->getRepository(Student::class);

        // Calculate total students and number of pages
        $qb = $repository->createQueryBuilder('s')
            ->leftJoin('s.notes', 'n') // Join with the notes entity
            ->leftJoin('n.ec', 'ec')  // Join with the EC (subject) entity
            ->addSelect('n') // Select the notes entity
            ->addSelect('ec'); // Select the EC (subject) entity

        // Fetch all fields for filtering options
        $fields = $doctrine->getRepository(Field::class)->findAll();
        
        // Retrieve search parameters from request
        $fieldId = $request->query->get('field');
        $name = $request->query->get('name');

        // Apply filters if provided
        if ($fieldId) {
            $qb->andWhere('s.field = :field')
                ->setParameter('field', $fieldId);
        }
        if ($name) {
            $qb->andWhere('s.name LIKE :name')
                ->setParameter('name', '%' . $name . '%');
        }

        // Fetch filtered students with pagination
        $students = $qb->getQuery()->getResult();

        // Pagination logic
        $nbre = $request->query->get('nbre', 12); // Default to 12 students per page
        $page = $request->query->get('page', 1); // Default to page 1

        $nbStudent = count($students);
        $nbPage = ceil($nbStudent / $nbre);
        $user = $this->getUser();
        // Apply pagination
        $students = $qb->setMaxResults($nbre)
            ->setFirstResult(($page - 1) * $nbre)
            ->getQuery()
            ->getResult();

        if (empty($students)) {
            throw new NotFoundHttpException('No students found.');
        }

        return $this->render('student/list1.html.twig', [
            'user'=>$user,
            'students' => $students,
            'isPaginated' => true,
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
    public function fields(EntityManagerInterface $entityManager): Response
    {
        // Check if the user has ROLE_ADMIN
        if (!$this->isGranted('ROLE_RPA')) {
            // Redirect to a custom error page
            return $this->render('student/error.html.twig', [
                'message' => 'Access Denied'
            ], new Response('', Response::HTTP_FORBIDDEN));
        }

        $user = $this->getUser();
        $fields = $entityManager->getRepository(Field::class)->findAll();

        return $this->render('responsable/field.html.twig', [
            'fields' => $fields,
            'user' => $user
        ]);
    }
    

    //list des etudiants en attente de validation d'inscription 

    #[Route('/list_student/{fieldId?1}/{page?1}/{nbre?12}', name: 'list_student_2')]
    public function ListStudent(Request $request, ManagerRegistry $doctrine, $fieldId, $page, $nbre): Response
    {

        // Check if the user has ROLE_ADMIN
        if (!$this->isGranted('ROLE_RPA')) {
            // Redirect to a custom error page
            return $this->render('student/error.html.twig', [
                'message' => 'Access Denied'
            ], new Response('', Response::HTTP_FORBIDDEN));
        }
        $user = $this->getUser();
        try {
            $entityManager = $doctrine->getManager();
    
            // Fetch the selected field
            $field = null;
            if ($fieldId) {
                $field = $entityManager->getRepository(Field::class)->find($fieldId);
                if (!$field) {
                    return $this->render('student/error.html.twig', ['message' => 'Cette filière n\'existe pas !']);
                }
            }
    
            // Fetch search parameters from request
            $name = $request->query->get('name');
    
            // Fetch students without user accounts in the specified field with pagination
            $qb = $entityManager->createQueryBuilder()
                ->select('s')
                ->from(Student::class, 's')
                ->leftJoin('s.userAccount', 'u')
                ->where('u.id IS NULL');
    
            if ($field) {
                $qb->andWhere('s.field = :fieldId')
                    ->setParameter('fieldId', $fieldId);
            }
    
            if ($name) {
                $qb->andWhere('s.name LIKE :name')
                    ->setParameter('name', '%' . $name . '%');
            }
    
            // Apply pagination
            $qb->orderBy('s.id', 'ASC') // Sort by student ID (optional)
                ->setFirstResult(($page - 1) * $nbre) // Apply pagination offset
                ->setMaxResults($nbre);
    
            $students = $qb->getQuery()->getResult();
    
            // Calculate total students without user accounts in the specified field
            $countQueryBuilder = $entityManager->createQueryBuilder()
                ->select('COUNT(s)')
                ->from(Student::class, 's')
                ->leftJoin('s.userAccount', 'u')
                ->where('u.id IS NULL');
    
            if ($field) {
                $countQueryBuilder->andWhere('s.field = :fieldId')
                    ->setParameter('fieldId', $fieldId);
            }
    
            if ($name) {
                $countQueryBuilder->andWhere('s.name LIKE :name')
                    ->setParameter('name', '%' . $name . '%');
            }
    
            $nbStudent = $countQueryBuilder->getQuery()->getSingleScalarResult();
            $nbPage = ceil($nbStudent / $nbre);
    
            if (!$students) {
                // Handle case where no students without user accounts are found
                return $this->render('student/error.html.twig', ['message' => 'Aucun étudiant trouvé !']);
            }
    
            // Retrieve all fields for filtering options
            $fields = $entityManager->getRepository(Field::class)->findAll();
            
    
            return $this->render('responsable/list_student.html.twig', [
                'user' => $user,
                'students' => $students,
                'field' => $field,
                'fields' => $fields,
                'isPaginated' => true,
                'nbPage' => $nbPage,
                'page' => $page,
                'nbre' => $nbre,
                'currentName' => $name,
                'currentField' => $fieldId,
            ]);
        } catch (\Exception $e) {
            // Handle the specific case of not finding students without user accounts
            return $this->render('student/error.html.twig', ['message' => $e]);
        }
    }
                         }
