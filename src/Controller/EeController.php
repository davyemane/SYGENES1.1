<?php

namespace App\Controller;

use App\Entity\Anonymat;
use App\Entity\EC;
use App\Entity\EE;
use App\Entity\School;
use App\Form\EECollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EeController extends AbstractController
{
    #[Route('/ee', name: 'app_ee')]
    public function index(): Response
    {
        return $this->render('ee/index.html.twig', [
            'controller_name' => 'EeController',
        ]);
    }

    #[Route('/ee/{ecId}', name: 'inserer_notes')]
    public function insererNotes(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {
        // Récupérer la session de l'utilisateur
        $session = $request->getSession();
        $schoolName = $session->get('school_name');

        if (!$schoolName) {
            throw $this->createAccessDeniedException('Aucune école sélectionnée dans la session.');
        }

        $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        if (!$school) {
            throw $this->createNotFoundException('École non trouvée.');
        }

        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        if (!$ec) {
            throw $this->createNotFoundException('EC non trouvé');
        }

        // Vérifiez que l'EC appartient à l'UE qui à son tour appartient à une filière de l'école en session
        $ue = $ec->getUe();
        $fields = $ue->getFields();

        if ($fields->isEmpty()) {
            throw $this->createNotFoundException('Aucun champ trouvé pour cette UE.');
        }

        $belongsToSchool = $fields->exists(function($key, $field) use ($school) {
            return $field->getSchool() === $school;
        });

        if (!$belongsToSchool) {
            throw $this->createAccessDeniedException('Vous n\'avez pas accès à cet EC dans l\'école actuelle.');
        }

        // Récupérer le nom de la première filière (supposons qu'il n'y en a qu'une)
        $field = $fields->first();
        $fieldName = $field ? $field->getName() : 'Non spécifié';

        $anonymats = $entityManager->getRepository(Anonymat::class)->findBy(['eC' => $ec]);

        $eeData = ['ees' => []];
        foreach ($anonymats as $anonymat) {
            $ee = new EE();
            $ee->setAnonymat($anonymat);
            $ee->setCreatedBy($this->getUser());
            $ee->setCreatedAt(new \DateTime());
            $eeData['ees'][] = $ee;
        }

        $form = $this->createForm(EECollectionType::class, $eeData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ees = $form->getData()['ees'];
            $totalPoints = $form->get('totalPoints')->getData();

            foreach ($ees as $ee) {
                $originalMark = $ee->getMark();
                if ($originalMark > $totalPoints) {
                    $this->addFlash('error', 'Une note dépasse le maximum autorisé.');
                    return $this->redirectToRoute('inserer_notes', ['ecId' => $ecId]);
                }

                // Convertir la note sur 20
                $convertedMark = ($originalMark / $totalPoints) * 20;
                $ee->setMark($convertedMark);

                // Calculer et définir le grade (exemple simplifié)
                $grade = $this->calculateGrade($convertedMark);
                $ee->setGrade($grade);

                $entityManager->persist($ee);
            }
            $entityManager->flush();

            $this->addFlash('success', 'Les notes ont été insérées avec succès.');
            return $this->redirectToRoute('app_dashAdmin');
        }

        return $this->render('ee/notes.html.twig', [
            'form' => $form->createView(),
            'ees' => $eeData['ees'],
            'anonymats' => $anonymats,
            'ec' => $ec,
            'ue' => $ue,
            'fieldName' => $fieldName,
        ]);
    }

    private function calculateGrade(float $mark): string
    {
        if ($mark >= 16) return 'A';
        if ($mark >= 14) return 'B';
        if ($mark >= 12) return 'C';
        if ($mark >= 10) return 'D';
        return 'E';
    }
}