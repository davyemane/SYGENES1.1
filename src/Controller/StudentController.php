<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\User;
use App\Event\AddStudentEvent;
use App\Form\StudentType;
use App\Repository\LevelRepository;
use App\Repository\NoteRepository;
use App\Repository\StudentRepository;
use App\Repository\UERepository;
use App\Security\LoginAuthenticator;
use App\services\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

#[Route('/student'), IsGranted('ROLE_USER')]
class StudentController extends AbstractController
{

    public function __construct(private EventDispatcherInterface $dispacher)
    {
        
    }

    // List of all students with error handling
    #[Route('/list/{page?1}/{nbre?12}', name: 'list_student')]
    public function home(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        try {
            $repository = $doctrine->getRepository(Student::class);

            // Calculate total students and number of pages
            $nbStudent = $repository->count([]);
            $nbPage = ceil($nbStudent / $nbre);

            // Fetch students with pagination (handle potential errors)
            $student = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);
            if (!$student) {
                // Handle case where no students are found
                throw new NotFoundHttpException('No students found.');
            }

            return $this->render('student/list.html.twig', [
                'students' => $student,
                'isPaginated' => true,
                'nbPage' => $nbPage,
                'page' => $page,
                'nbre' => $nbre,
            ]);
        } catch (NotFoundHttpException $e) {
            // Handle the specific case of not finding students
            $this->addFlash('error', 'No students found.');
            return $this->redirectToRoute('list_student', ['page' => 1]); // Redirect to first page
        } catch (\Exception $e) {
            // Catch other unexpected exceptions for broader error handling
            $this->addFlash('error', 'An error occurred.'); // Generic error message
            // Log the error for further investigation
            error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3, 'path/to/your/error.log'); // Replace with your log path
            return $this->redirectToRoute('list_student', ['page' => 1]); // Redirect to first page
        }
    }


    //detail of one student
    #[Route('/listDetail/{id<\d+>}', name: 'detail_student')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
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
        } catch (\Exception $e) {
            // Catch other unexpected exceptions for broader error handling
            $this->addFlash('error', 'An error occurred.'); // Generic error message
            // Log the error for further investigation
            error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3, 'path/to/your/error.log'); // Replace with your log path
            return $this->redirectToRoute('list_student');
        }
    }
    

//update or add student
#[Route('/add/{id?0}', name: 'add_student')]
public function academicInscription($id, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
{
    $studentDirectory = 'student_directory';
    $entityManager = $doctrine->getManager();

    // Vérifier si un ID d'étudiant a été fourni
    if ($id) {
        $student = $entityManager->getRepository(Student::class)->find($id);
    } else {
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

    return $this->render('student/accademicInscription.html.twig', ['form' => $form->createView()]);
}

#[Route('/pdf/{id}', name: "pdf_student")]
public function generatePdf($id, ManagerRegistry $doctrine, Dompdf $domPdf)
{
    $repository = $doctrine->getRepository(Student::class);
    
    $student = $repository->find($id);

    $html = $this->renderView('note/releve_notes.html.twig', ['student' => $student]);

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $domPdf->setOptions($options);
    $domPdf->loadHtml($html);
    $domPdf->render();
    
    // Output the generated PDF
    $domPdf->stream("releve_notes.pdf", [
        "Attachment" => false // Change to true if you want to force download
    ]);
}



#[Route('/{id}/notes', name: 'student_notes')]
public function studentNotes(Request $request, StudentRepository $studentRepository, NoteRepository $noteRepository, $id, LevelRepository $levelRepository, UERepository $ueRepository)
{

    // Récupérer l'étudiant connecté
    $currentUser = $this->getUser();
    $message = '';
        
    
    // Vérifier si l'utilisateur connecté est autorisé à accéder aux notes demandées
    if ($currentUser->getStudent()->getId() != $id) {

        $message = 'acces refusé';

        return $this->render('student/error.html.twig', ['message'=>$message]);
        // L'utilisateur connecté n'est pas autorisé à accéder à ces notes
        // Rediriger vers une page d'erreur ou afficher un message approprié
        // par exemple : throw $this->createAccessDeniedException('You are not allowed to access these notes.');
    }
    

    $student = $studentRepository->find($id);
    if (!$student) {
        throw $this->createNotFoundException('Student not found.');
    }

    $notes = $noteRepository->findBy(['student' => $student]);

    $notesByUe = []; // Changed to notesByUe for clarity
    foreach ($notes as $note) {
        $ue = $note->getEc()->getUe(); // Assuming relationships are set correctly

        $notesByUe[$ue->getId()][] = $note;
    }

    $levels = $levelRepository->findAll();

    // Process notesByUe to group by level, UE, and add validation status
    $processedNotes = [];
    foreach ($notesByUe as $ueId => $ueNotes) {
        $levelId = $ue->getLevel()->getId();
        foreach ($ueNotes as $note) {
            $totalScore = $note->getCc() + $note->getTp() + $note->getSn();
            $validated = $totalScore >= 50 && $totalScore <= 100;
            $processedNotes[$levelId][$ueId][] = [
                'note' => $note,
                'validated' => $validated,
            ];
        }
    }

    return $this->render('student/notes.html.twig', [
        'student' => $student,
        'processedNotes' => $processedNotes,
        'levels' => $levels,
        'ueRepository' => $ueRepository, // Pass ueRepository to the template
    ]);
}



//creer automatiquement un compte a un etudiant 
#[Route('/create-account/{studentId}', name: 'create_student_account')]
    public function createAccountForStudent(
        int $studentId,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        LoginAuthenticator $authenticator,
        Request $request,
        MailerInterface $mailer
    ): Response 
    {
        $new = true;
        // Récupérer l'étudiant par son ID
        $student = $entityManager->getRepository(Student::class)->find($studentId);

        if (!$student) {
            throw $this->createNotFoundException('Student not found');
            $new = false;
        }

        // Vérifier si l'étudiant a déjà un compte utilisateur
        if ($student->getUserAccount()) {
            $new = false;
            $this->addFlash('error', 'Student already has an account');
            return $this->redirectToRoute('list_student_2'); // Rediriger vers une page appropriée
        }

        // Créer un nouvel utilisateur et lier avec l'étudiant
        $user = new User();
        $user->setUsername($student->getEmail());  // Utiliser l'email de l'étudiant comme nom d'utilisateur
        $user->setEmail($student->getEmail());
        $user->setStudent($student);
        $user->setRoles(['ROLE_USER']);

        // Utiliser l'email comme mot de passe
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $student->getEmail()
            )
        );

        // Persister et sauvegarder le nouvel utilisateur
        $entityManager->persist($user);
        $entityManager->flush();

        // // Envoyer une notification par email
        // $email = (new Email())
        //     ->from('davyemane1@gmail.com')
        //     ->to($student->getEmail())
        //     ->subject('Account Created')
        //     ->html('<p>Your account has been created. Your username and password is your email address.</p>');

        // $mailer->send($email);

        // Ajouter un message flash de succès
        $this->addFlash('success', 'Account created successfully');


//j'ai créé un evennement 
        if ($new) 
        {
            $addStudentEvent = new AddStudentEvent(
                $student
            );

            $this->dispacher->dispatch($addStudentEvent, AddStudentEvent::ADD_STUDENT_EVENT);
        }

        // Rediriger vers une autre page
        return $this->redirectToRoute('app_home_page');
    }

}
