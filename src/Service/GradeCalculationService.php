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

            if ($ee) {
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
        if ($eeGrade === null) {
            return null;
        }

        $noteCcTp = $this->entityManager->getRepository(NoteCcTp::class)->findOneBy([
            'eC' => $ec,
            'student' => $student
        ]);

        if ($noteCcTp === null) {
            return null;
        }

        $totalGrade = 0;

        if ($noteCcTp->hasTp()) {
            // Si NoteCcTp a une note de TP
            // EE sur 50, TP sur 20, CC sur 30
            $totalGrade += ($eeGrade / 70) * 50; // Ramener la note EE sur 50
            if ($noteCcTp->getTp() !== null) {
                $totalGrade += $noteCcTp->getTp() * (20 / 100);
            }
            if ($noteCcTp->getCc() !== null) {
                $totalGrade += $noteCcTp->getCc() * (30 / 100);
            }
        } else {
            // Si NoteCcTp n'a pas de TP
            // EE sur 70, CC sur 30
            $totalGrade += $eeGrade; // La note EE reste sur 70
            if ($noteCcTp->getCc() !== null) {
                $totalGrade += $noteCcTp->getCc() * (30 / 100);
            }
        }

        // Convertir la note totale sur une échelle de 20
        return round(($totalGrade / 100) * 20, 2);
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
        $totalCredits = 0;

        foreach ($ue->getECs() as $ec) {
            $ecGrade = $this->calculateStudentECGrade($ec, $student);
            if ($ecGrade === null) {
                return null;
            }

            $ecCredit = floatval($ec->getCredit());
            $totalGrade += $ecGrade * $ecCredit;
            $totalCredits += $ecCredit;
        }

        if ($totalCredits === 0) {
            return null;
        }

        return round($totalGrade / $totalCredits, 2);
    }
}
