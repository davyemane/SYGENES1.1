<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Student;
use App\Entity\UE;
use App\Service\GradeCalculationService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;


class GradeController extends AbstractController
{
    private $gradeCalculationService;
    private $entityManager;

    public function __construct(GradeCalculationService $gradeCalculationService, EntityManagerInterface $entityManager)
    {
        $this->gradeCalculationService = $gradeCalculationService;
        $this->entityManager = $entityManager;
    }

    #[Route('/student/{id}/transcript', name: 'pdf_student')]
    public function generateTranscript(int $id): Response
    {
        $user = $this->getUser();
        $student = $this->entityManager->getRepository(Student::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException('Student not found');
        }

        $currentLevel = $student->getLevel();
        $ues = $this->entityManager->getRepository(UE::class)->findBy(['level' => $currentLevel]);

        $grades = [];
        $totalWeightedGrade = 0;
        $totalCredits = 0;

        foreach ($ues as $ue) {
            $average = $this->gradeCalculationService->calculateStudentUEAverage($ue, $student);
            $grade = $this->getGradeFromAverage($average);
            $gradePoint = $this->getGradePoint($grade);
            $credits = $ue->getCredit();

            $grades[] = [
                'ue' => $ue->getName(),
                'average' => $average,
                'grade' => $grade,
                'credits' => $credits,
            ];

            $totalWeightedGrade += $gradePoint * $credits;
            $totalCredits += $credits;
        }

        $mpc = $totalCredits > 0 ? $totalWeightedGrade / $totalCredits : 0;

        // Generate PDF
        $html = $this->renderView('pdf/releve_notes.html.twig', [
            'student' => $student,
            'grades' => $grades,
            'mpc' => $mpc,
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfContent = $dompdf->output();

        return new Response(
            $pdfContent,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="transcript.pdf"',
                
            ]
        );
    }

    private function getGradeFromAverage(?float $average): string
    {
        if ($average === null) {
            return 'N/A';
        }

        if ($average >= 16) return 'A';
        if ($average >= 14) return 'B';
        if ($average >= 12) return 'C';
        if ($average >= 10) return 'D';
        return 'E';
    }

    private function getGradePoint(string $grade): int
    {
        switch ($grade) {
            case 'A': return 4;
            case 'B': return 3;
            case 'C': return 2;
            case 'D': return 1;
            default: return 0;
        }
    }
}
