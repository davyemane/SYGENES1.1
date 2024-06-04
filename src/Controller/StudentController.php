<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\LevelRepository;
use App\Repository\NoteRepository;
use App\Repository\StudentRepository;
use App\services\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/student')]
class StudentController extends AbstractController
{
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

//generer un pdf 
#[Route('/pdf/{id}',name:"pdf_student")]
public function generatePdf($id, PdfService $pdf, ManagerRegistry $doctrine)
{
    $repository = $doctrine->getRepository(Student::class);
    
    // Fetch student details (handle potential exceptions)
    $student = $repository->find($id);

    $html = $this->render('student/detail.html.twig', ['student' => $student]);
    $pdf->ShowPdfFile($html);

}

#[Route('/{id}/notes', name: 'student_notes')]
public function studentNotes(Request $request, StudentRepository $studentRepository, NoteRepository $noteRepository, $id, LevelRepository $levelRepository)
{
    $student = $studentRepository->find($id);
    if (!$student) {
        throw $this->createNotFoundException('Student not found.');
    }

    $notes = $noteRepository->findBy(['student' => $student]);

    $notesByLevel = [];
    foreach ($notes as $note) {
        $level = $note->getEc()->getUe()->getLevel(); // Assuming relationships are set correctly

        $notesByLevel[$level->getId()][] = $note;
    }
    

    $levels = $levelRepository->findAll();

    return $this->render('student/notes.html.twig', [
        'student' => $student,
        'notesByLevel' => $notesByLevel,
        'levels' => $levels,
    ]);
}


}
