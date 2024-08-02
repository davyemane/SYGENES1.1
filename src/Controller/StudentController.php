<?php

namespace App\Controller;

use App\Entity\Field;
use App\Entity\Note;
use App\Entity\Role;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\UE;
use App\Entity\User;
use App\Event\AddStudentEvent;
use App\Form\StudentType;
use App\Repository\LevelRepository;
use App\Repository\NoteCcTpRepository;
use App\Repository\NoteRepository;
use App\Repository\StudentRepository;
use App\Repository\UERepository;
use App\Security\LoginAuthenticator;
use App\services\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


#[Route('student')]
class StudentController extends AbstractController
{

    public function __construct(
        private EventDispatcherInterface $dispatcher,
        private RequestStack $requestStack,
    ) {
    }

    #[Route('/student_statistics', name: 'student_stats')]
    public function statistics(Request $request, ManagerRegistry $doctrine): Response
    {

        $user = $this->getUser();
        $student = $user->getStudent();
        return $this->render('student_dashboard/statistics.html.twig', [
            "user" => $user,
            "student" => $student,
        ]);
    }


    #[Route('/list/{page?1}/{nbre?12}', name: 'list_student')]
    public function home(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager ,$page, $nbre): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        //ici je recupere la session de l'utilisateur 
        $session = $this->requestStack->getSession();
        $schoolName = $session->get('school_name');
        $school = null;

        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'List Students') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }

        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        $repository = $doctrine->getRepository(Student::class);
        $queryBuilder = $repository->createQueryBuilder('s');

        // Fetch all students initially without filters
        $queryBuilderTotal = clone $queryBuilder;
        $nbStudent = $queryBuilderTotal->select('COUNT(s.id)')->getQuery()->getSingleScalarResult();
        $nbPage = ceil($nbStudent / $nbre);

        // Retrieve search parameters from request
        $name = $request->query->get('name');
        $fieldId = $request->query->get('field');

        // Apply filters if provided
        if ($name) {
            $queryBuilder->andWhere('s.name LIKE :name')->setParameter('name', '%' . $name . '%');
        }
        if ($fieldId) {
            $queryBuilder->andWhere('s.field = :field')->setParameter('field', $fieldId);
        }

        // Fetch filtered students with pagination
        $students = $queryBuilder->setMaxResults($nbre)
            ->setFirstResult(($page - 1) * $nbre)
            ->getQuery()
            ->getResult();

        if (empty($students)) {
            // Log the filters applied for debugging
            $filtersApplied = [
                'name' => $name,
                'fieldId' => $fieldId,
            ];
            return $this->render('student/error.html.twig', [
                'message' => 'Aucun étudiant trouvé',
                'filters' => $filtersApplied, // Display filters for debugging
            ]);
        }

        // Retrieve all fields for filtering options
        $fields = $doctrine->getRepository(Field::class)->findAll();

        return $this->render('student/list.html.twig', [
            'students' => $students,
            'isPaginated' => true,
            'nbPage' => $nbPage,
            'page' => $page,
            'nbre' => $nbre,
            'currentName' => $name,
            'currentField' => $fieldId,
            'fields' => $fields,
        ]);
    }

    //detail of one student
    #[Route('/listDetail/{id<\d+>}', name: 'detail_student')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'Detail Student') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }

        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }

        try {
            $repository = $doctrine->getRepository(Student::class);

            // Fetch student details (handle potential exceptions)
            $student = $repository->find($id);
            if (!$student) {
                // Handle case where student is not found
                throw new NotFoundHttpException('Student with ID ' . $id . ' not found.');
            }

            return $this->render('student/detail.html.twig', ['student' => $student]);
        } catch (NotFoundHttpException $e) {
            // Handle specific case of student not found
            $this->addFlash('error', 'Student not found.'); // More user-friendly message
            return $this->redirectToRoute('list_student');
        }
    }


    //update or add student
    #[Route('/add/{id?0}', name: 'add_student')]
    public function academicInscription($id, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'Add Student') {
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
            $student = $entityManager->getRepository(Student::class)->find($id);
            $studentDirectory = 'uploads/certificates';
        } else {
            // Check if the user has ROLE_ADMIN
            $student = new Student();
        }

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Handle file uploads with try-catch blocks
            try {

                // Photo de Bac
                $photoBac = $form->get('photoBac')->getData();
                if ($photoBac) {
                    $originalFilename = pathinfo($photoBac->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoBac->guessExtension();
                    $photoBac->move($studentDirectory, $newFilename);
                    $student->setAdmissionCertificate($newFilename);
                }

                // Acte de Naissance
                $Certificate = $form->get('Certificate')->getData();
                if ($Certificate) {
                    $originalFilename = pathinfo($Certificate->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $Certificate->guessExtension();
                    $Certificate->move($studentDirectory, $newFilename);
                    $student->setBirthCertificate($newFilename);
                }
            } catch (FileException $e) {
                // Handle file upload exceptions (e.g., disk space issues, invalid file types)
                $this->addFlash('error', 'An error occurred while uploading files: ' . $e->getMessage());
                // Consider logging the error for further investigation
            }

            $entityManager->persist($student);
            $entityManager->flush();

            $message = $id ? 'mis à jour' : 'ajouté';
            $this->addFlash('success', $student->getName() . " a été $message avec succès !");

            return $this->redirectToRoute("list_student");
        }

        return $this->render('student/accademicInscription.html.twig', [
            'form' => $form->createView(),
            "student" => $student
        ]);
    }

    // src/Controller/StudentController.php

    #[Route('/pdf/{id}', name: "transcript")]
    public function generatePdf($id, ManagerRegistry $doctrine, Dompdf $domPdf)
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }



        $studentRepository = $doctrine->getRepository(Student::class);
        $student = $studentRepository->find($id);

        if (!$student) {
            throw $this->createNotFoundException('Étudiant non trouvé');
        }

        $noteRepository = $doctrine->getRepository(Note::class);
        $notes = $noteRepository->findBy(['student' => $student]);

        // Récupérer toutes les UEs associées aux notes de l'étudiant
        $ues = [];
        foreach ($notes as $note) {
            $ec = $note->getEc();
            if ($ec) {
                $ue = $ec->getUe();
                if ($ue) {
                    $ues[$ue->getId()] = $ue;
                }
            }
        }

        // Calcul des crédits et des points
        $total_credits_valides = 0;
        $total_points = 0;
        foreach ($notes as $note) {
            $finalGrade = $note->getFinalGrade();
            if ($finalGrade !== null && $finalGrade >= 10) { // Supposons que 10 est la note de validation
                $ec = $note->getEc();
                if ($ec) {
                    $total_credits_valides += $ec->getCredit();
                    $total_points += $finalGrade * $ec->getCredit();
                }
            }
        }

        $credits_restants = 60 - $total_credits_valides; // Supposons que le total des crédits soit 180
        $mpc = $total_credits_valides > 0 ? $total_points / $total_credits_valides : 0;

        // Déterminer les grades pour chaque note
        $grades = [];
        foreach ($notes as $note) {
            $finalGrade = $note->getFinalGrade();
            $grade = '';
            if ($finalGrade >= 16) {
                $grade = 'A';
            } elseif ($finalGrade >= 14) {
                $grade = 'B';
            } elseif ($finalGrade >= 12) {
                $grade = 'C';
            } elseif ($finalGrade >= 10) {
                $grade = 'D';
            } else {
                $grade = 'E';
            }
            $grades[$note->getId()] = $grade;
        }

        // Rendu HTML
        $html = $this->renderView('pdf/releve_notes.html.twig', [
            'student' => $student,
            'notes' => $notes,
            'ues' => $ues,
            'total_credits_valides' => $total_credits_valides,
            'credits_restants' => $credits_restants,
            'mpc' => number_format($mpc, 2),
            'grades' => $grades
        ]);

        // Configuration et génération du PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $domPdf->setOptions($options);
        $domPdf->loadHtml($html);
        $domPdf->setPaper('A4', 'portrait');
        $domPdf->render();

        return new Response(
            $domPdf->output(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="releve_notes_' . $student->getStudentID() . '.pdf"'
            ]
        );
    }


    #[Route('/{id}/notes', name: 'student_notes')]
    public function studentNotes(Request $request, StudentRepository $studentRepository, NoteCcTpRepository $noteRepository, $id, LevelRepository $levelRepository, UERepository $ueRepository)
    {
        // Récupérer l'étudiant connecté
        $currentUser = $this->getUser();
        $message = '';
    
        // Vérifier si l'utilisateur connecté est autorisé à accéder aux notes demandées
        if ($currentUser->getStudent()->getId() != $id) {
            $message = 'Accès refusé';
            return $this->render('student/error.html.twig', ['message' => $message]);
        }
    
        $student = $studentRepository->find($id);
        if (!$student) {
            $message = "Pas d'étudiant avec cet identifiant";
            return $this->render('student/error.html.twig', [
                'message' => $message,
                'user' => $currentUser
            ]);
        }
    
        $currentLevel = $student->getLevel();
        $allLevels = $levelRepository->findAll();
        
        // Trouver l'index du niveau actuel
        $currentLevelIndex = array_search($currentLevel, $allLevels);
        
        // Sélectionner le niveau actuel et les niveaux précédents
        $relevantLevels = array_slice($allLevels, 0, $currentLevelIndex + 1);
    
        $notes = $noteRepository->findBy(['student' => $student]);
    
        $notesByLevelAndUe = [];
        foreach ($notes as $note) {
            $ue = $note->getEc()->getUe();
            $level = $ue->getLevel();
            if (in_array($level, $relevantLevels)) {
                $notesByLevelAndUe[$level->getId()][$ue->getId()][] = $note;
            }
        }
    
        // Traiter les notes pour les regrouper par niveau et UE
        $processedNotes = [];
        foreach ($notesByLevelAndUe as $levelId => $levelNotes) {
            foreach ($levelNotes as $ueId => $ueNotes) {
                foreach ($ueNotes as $note) {
                    $processedNotes[$levelId][$ueId][] = [
                        'note' => $note,
                        'cc' => $note->getCc(),
                        'tp' => $note->getTp(),
                    ];
                }
            }
        }
    
        return $this->render('student/notes.html.twig', [
            'user' => $currentUser,
            'student' => $student,
            'processedNotes' => $processedNotes,
            'relevantLevels' => $relevantLevels,
            'ueRepository' => $ueRepository,
        ]);    }


    //creer automatiquement un compte a un etudiant 
    #[Route('/create-account/{studentId}/{fieldId}', name: 'create_student_account')]
    public function createAccountForStudent(
        int $studentId,
        int $fieldId,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
    ): Response {

        //ici je recupere l'utilisateur connecté
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }


        //ici je recupere la session de l'utilisateur 
        $session = $this->requestStack->getSession();
        $schoolName = $session->get('school_name');
        $school = null;

        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        }



        // Vérifier si l'utilisateur a le privilège "de valider l'etudiant"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'Validate Student') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }


        $new = true;
        // Récupérer l'étudiant par son ID
        $student = $entityManager->getRepository(Student::class)->find($studentId);

        if (!$student) {
            $new = false;
            throw $this->createNotFoundException('Student not found');
        }

        // Vérifier si l'étudiant a déjà un compte utilisateur
        if ($student->getUserAccount()) {
            $new = false;
            $this->addFlash('error', 'Student already has an account');
            return $this->redirectToRoute('list_student_2'); // Rediriger vers une page appropriée
        }



        // Créer un nouvel utilisateur et lier avec l'étudiant

        $username = '';
        if (!empty($student->getCni())) {
            $username = $student->getCni();
        } elseif (!empty($student->getPhoneNumber())) {
            $username = $student->getPhoneNumber();
        }

        $user = new User();
        $user->setUsername($username);  // Utiliser la cni ou le numero de telephone de l'étudiant comme nom d'utilisateur
        $user->setEmail($student->getEmail());
        $user->setStudent($student);

        //ici je recupere le role de l'etudiant
        $studentRole = $entityManager->getRepository(Role::class)->findOneBy(['name' => 'Student']);
        if ($studentRole) {
            $user->addRole($studentRole);
        } else {
            return $this->render('student/error.html.twig', ['message' => 'Le Profile Student n\'existe pas. Veillez contacter l\'administrateur.']);
        }


        // Utiliser l'email comme mot de passe par défaut
        $userPassword = '';

        if (!empty($student->getCni())) {
            $userPassword = $student->getCni();
        } elseif (!empty($student->getPhoneNumber())) {
            $userPassword = $student->getPhoneNumber();
        }
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $userPassword
            )
        );

        // Persister et sauvegarder le nouvel utilisateur
        $entityManager->persist($user);
        $entityManager->flush();


        $routeParams = [];

        if ($fieldId) {
            $routeParams['fieldId'] = $fieldId;
        }
    
        // Ajouter un message flash de succès
        $this->addFlash('success', 'Account created successfully');
    
        // Rediriger vers list_student_2 avec l'identifiant de la filière
        return $this->redirectToRoute('list_student_2', $routeParams);
        }
}
