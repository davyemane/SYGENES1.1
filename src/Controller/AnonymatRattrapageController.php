<?php

namespace App\Controller;

use App\Entity\AnonymatRattrapage;
use App\Entity\EC;
use App\Entity\Student;
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


    #[Route('/anonymats-rattrapage/{ecId}', name: 'attribuer_anonymats_rattrapage')]
    public function attribuerAnonymats(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {
        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        if (!$ec) {
            throw $this->createNotFoundException('EC non trouvé');
        }
    
        $ue = $ec->getUe();
        $fields = $ue->getFields();
    
        $students = $entityManager->getRepository(Student::class)->findBy(['field' => $fields->toArray()]);
    
        $anonymatsData = [];
        foreach ($students as $student) {
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
            'students' => $students,
            'ec' => $ec,
        ]);
    }
}
