<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\NoteCcTp;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NoteCCController extends AbstractController
{
    #[Route('/note/c/c', name: 'app_note_c_c')]
    public function index(): Response
    {
        return $this->render('note_cc/index.html.twig', [
            'controller_name' => 'NoteCCController',
        ]);
    }

    #[Route('/insert-notes/{ecId}', name: 'insert_notes')]
    public function insertNotes(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {
        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        if (!$ec) {
            throw $this->createNotFoundException('EC non trouvé');
        }

        $ue = $ec->getUe();
        if (!$ue) {
            throw $this->createNotFoundException('UE non trouvée pour cet EC');
        }


        $fields= [];
        foreach ($ue->getFields() as $field) {
            $fields[] = $field->getId();
        }

        if (empty($fields)) {
            throw $this->createNotFoundException('Aucune filière trouvée pour cette UE');
        }

        // Récupérer les étudiants des filières associées à l'UE
        $students = $entityManager->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->where('s.field IN (:fields)')
            ->setParameter('fields', $fields)
            ->getQuery()
            ->getResult();

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $now = new \DateTime();
            $user = $this->getUser();

            foreach ($students as $student) {
                $noteCcTp = new NoteCcTp();
                $noteCcTp->setEC($ec);
                $noteCcTp->setStudent($student);
                $noteCcTp->setCreatedAt($now);
                $noteCcTp->setCreatebBy($user);
                $noteCcTp->setHasTp($ec->getHasTp());

                $ccNote = $data['cc_' . $student->getId()] ?? null;
                $noteCcTp->setCc($ccNote ? floatval($ccNote) : null);

                if ($ec->getHasTp()) {
                    $tpNote = $data['tp_' . $student->getId()] ?? null;
                    $noteCcTp->setTp($tpNote ? floatval($tpNote) : null);
                }

                $entityManager->persist($noteCcTp);
            }
            $entityManager->flush();

            $this->addFlash('success', 'Les notes ont été enregistrées avec succès.');
            return $this->redirectToRoute('insert_notes', ['ecId' => $ecId]);
        }

        return $this->render('note_cc/insert_notes.html.twig', [
            'ec' => $ec,
            'students' => $students,
        ]);
    }
}
