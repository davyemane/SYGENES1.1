<?php

namespace App\Service;

use App\Entity\EC;
use App\Entity\Student;
use App\Entity\UE;
use App\Entity\EE;
use App\Entity\Anonymat;
use App\Entity\NoteCcTp;
use Doctrine\ORM\EntityManagerInterface;

class GradeCalculationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Récupère la note d'examen (EE) d'un étudiant pour une EC spécifique.
     *
     * @param EC $ec L'EC concernée
     * @param Student $student L'étudiant dont on veut récupérer la note
     * @return float|null La note EE de l'étudiant, ou null si non trouvée
     */
    public function getStudentEEGrade(EC $ec, Student $student): ?float
    {
        $anonymat = $this->entityManager->getRepository(Anonymat::class)->findOneBy([
            'eC' => $ec,
            'student' => $student
        ]);

        if ($anonymat) {
            $ee = $this->entityManager->getRepository(EE::class)->findOneBy([
                'anonymat' => $anonymat
            ]);

            if ($ee && $ee->getMark() !== null) {
                return $ee->getMark();
            }
        }

        return null;
    }

    /**
     * Calcule la note finale d'un étudiant pour une EC spécifique (CC + TP + EE).
     *
     * @param EC $ec L'EC concernée
     * @param Student $student L'étudiant dont on veut calculer la note
     * @return float|null La note finale sur 20, ou null si des données sont manquantes
     */
    public function calculateStudentECGrade(EC $ec, Student $student): ?float
    {
        $eeGrade = $this->getStudentEEGrade($ec, $student);
        $noteCcTp = $this->entityManager->getRepository(NoteCcTp::class)->findOneBy([
            'eC' => $ec,
            'student' => $student
        ]);

        if ($noteCcTp === null) {
            return null;
        }

        $totalGrade = 0;
        $totalWeight = 0;

        // Calcul de la note EE (examen)
        if ($eeGrade !== null) {
            $eeWeight = $noteCcTp->hasTp() ? 50 : 70; // 50 points si TP, sinon 70 points
            $totalGrade += $eeGrade * ($eeWeight / 100);
            $totalWeight += $eeWeight;
        }

        // Calcul de la note CC (contrôle continu)
        $ccGrade = $noteCcTp->getCc();
        if ($ccGrade !== null) {
            $ccWeight = 30; // 30 points pour CC
            $totalGrade += $ccGrade * ($ccWeight / 100);
            $totalWeight += $ccWeight;
        }

        // Calcul de la note TP (travaux pratiques)
        if ($noteCcTp->hasTp()) {
            $tpGrade = $noteCcTp->getTp();
            if ($tpGrade !== null) {
                $tpWeight = 20; // 20 points pour TP
                $totalGrade += $tpGrade * ($tpWeight / 100);
                $totalWeight += $tpWeight;
            }
        }

        // Si aucune note n'a été trouvée, retourner null
        if ($totalWeight == 0) {
            return null;
        }

        // Convertir la note sur 20
        $finalGrade = ($totalGrade / $totalWeight) * 20;

        // Arrondir à deux décimales
        return round($finalGrade, 2);
    }
    /**
     * Calcule la moyenne de l'UE pour un étudiant en fonction des notes de toutes les ECs.
     *
     * @param UE $ue L'UE concernée
     * @param Student $student L'étudiant dont on veut calculer la moyenne de l'UE
     * @return float|null La moyenne de l'UE sur 20, ou null si des données sont manquantes
     */
    public function calculateStudentUEAverage(UE $ue, Student $student): ?float
    {
        $totalGrade = 0;
        $ecCount = 0;

        foreach ($ue->getECs() as $ec) {
            $ecGrade = $this->calculateStudentECGrade($ec, $student);
            if ($ecGrade !== null) {
                // Assurons-nous que la note est bien sur 20
                $ecGrade = min(max($ecGrade, 0), 20);
                $totalGrade += $ecGrade;
                $ecCount++;
            }
        }

        if ($ecCount === 0) {
            return null;
        }

        $average = $totalGrade / $ecCount;

        // Assurons-nous que la moyenne finale est bien sur 20
        $average = min(max($average, 0), 20);

        return round($average, 2);
    }
    /**
     * Convertit une note numérique en grade littéral.
     *
     * @param float|null $average La note moyenne
     * @return string Le grade littéral correspondant
     */
    public function getGradeFromAverage(?float $average): string
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

    /**
     * Convertit un grade littéral en points de grade.
     *
     * @param string $grade Le grade littéral
     * @return int Les points de grade correspondants
     */
    public function getGradePoint(string $grade): int
    {
        switch ($grade) {
            case 'A':
                return 4;
            case 'B':
                return 3;
            case 'C':
                return 2;
            case 'D':
                return 1;
            default:
                return 0;
        }
    }
}
