<?php

namespace App\Controller;

use App\Entity\AnonymatRattrapage;
use App\Entity\EC;
use App\Entity\Student;
use App\Entity\EE;
use App\Entity\School;
use App\Form\AnonymatRattrapageCollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnonymatRattrapageController extends AbstractController
{
    #[Route('/anonymat/rattrapage', name: 'app_anonymat_rattrapage')]
    public function index(): Response
    {
        return $this->render('anonymat_rattrapage/index.html.twig', [
            'controller_name' => 'AnonymatRattrapageController',
        ]);
    }

    #[Route('/anonymats-rattrapage/{ecId<\d+>}', name: 'attribuer_anonymats_rattrapage')]
    public function attribuerAnonymats(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
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

        // Récupérer les étudiants qui n'ont pas de note d'examen pour cet EC
        $studentsWithoutExam = $entityManager->createQueryBuilder()
        ->select('s')
        ->from(Student::class, 's')
        ->leftJoin('s.anonymat', 'a')
        ->leftJoin('App\Entity\EE', 'ee', 'WITH', 'ee.anonymat = a')
        ->where('s.field IN (:fields)')
        ->andWhere('a.eC = :ec')
        ->andWhere('ee.id IS NULL OR ee.mark IS NULL')
        ->setParameter('fields', $fields)
        ->setParameter('ec', $ec)
        ->getQuery()
        ->getResult();
        
        $anonymatsData = [];
        foreach ($studentsWithoutExam as $student) {
            $anonymat = new AnonymatRattrapage();
            $anonymat->setStudent($student);
            $anonymat->setEC($ec);
            $anonymatsData[] = $anonymat;
        }
        
        $form = $this->createForm(AnonymatRattrapageCollectionType::class, ['anonymats' => $anonymatsData]);    
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anonymats = $form->getData()['anonymats'];
            foreach ($anonymats as $anonymat) {
                $entityManager->persist($anonymat);
            }
            $entityManager->flush();
        
            $this->addFlash('success', 'Les anonymats de rattrapage ont été attribués avec succès.');
            return $this->redirectToRoute('app_dashAdmin');
        }

        return $this->render('anonymat_rattrapage/attribuer.html.twig', [
            'form' => $form->createView(),
            'students' => $studentsWithoutExam,
            'ec' => $ec,
            'ue' => $ue,
            'fieldName' => $fieldName,
        ]);
    }
}