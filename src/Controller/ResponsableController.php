<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\Responsable;
use App\Entity\Student;
use App\Entity\UE;
use App\Form\ResponsableType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin'), IsGranted('ROLE_ADMIN')]
class ResponsableController extends AbstractController
{
    #[Route('/responsable', name: 'app_responsable')]
    public function index(): Response
    {
        return $this->render('responsable/index.html.twig', [
            'controller_name' => 'ResponsableController',
        ]);
    }


    #[Route('/add/resp/{id?0}', name: 'add_responsable')]
    public function academicInscription($id, ManagerRegistry $doctrine, Request $request): Response
    {
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

        return $this->render('responsable/add.html.twig', ['form' => $form->createView()]);
    }

    #[Route("/list/ec/", name:"choix_ec")]
    public function Ec(ManagerRegistry $doctrine): Response
    {
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
    
        return $this->render('ue/listEc.html.twig', ['data' => $data]);
    }
    

//liste des etudiants avec leurs notes dans une matiere spécifique 
    #[Route('/list/{page?1}/{nbre?12}/{ec?1}', name: 'list_student_notes')]
    public function home(ManagerRegistry $doctrine, $page, $nbre, $ec): Response
    {
        try {
            $repository = $doctrine->getRepository(Student::class);

            // Calculate total students and number of pages
            $nbStudent = $repository->count([]);
            $nbPage = ceil($nbStudent / $nbre);


            // Fetch students with pagination and include their associated notes
            $queryBuilder = $repository->createQueryBuilder('s')
            ->leftJoin('s.notes', 'n') // Join with the notes entity
            ->leftJoin('n.ec', 'ec')  // Join with the EC (subject) entity
            ->addSelect('n') // Select the notes entity
            ->addSelect('ec') // Select the EC (subject) entity
            ->where('ec.id = :subjectId')
            ->setParameter('subjectId', $ec)
            ->setMaxResults($nbre)
            ->setFirstResult(($page - 1) * $nbre);

            $students = $queryBuilder->getQuery()->getResult();

            if (!$students) {
                throw new NotFoundHttpException('No students found.');
            }

            $students = $queryBuilder->getQuery()->getResult();


            return $this->render('student/list1.html.twig', [
                'students' => $students,
                'isPaginated' => true,
                'nbPage' => $nbPage,
                'page' => $page,
                'nbre' => $nbre,
            ]);
        } catch (NotFoundHttpException $e) {
            $this->addFlash('error', 'No students found.');
            return $this->redirectToRoute('list_student', ['page' => 1]);
        } catch (\Exception $e) {
            $this->addFlash('error', 'An error occurred.');
            //error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3,'path/to/your/error.log');
            return $this->redirectToRoute('list_student', ['page' => 1]);
        }
    }
}
