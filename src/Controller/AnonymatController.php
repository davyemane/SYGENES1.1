<?php

namespace App\Controller;

use App\Entity\Anonymat;
use App\Entity\EC;
use App\Entity\Student;
use App\Form\AnonymatCollectionType;
use App\Form\AnonymatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnonymatController extends AbstractController
{
    #[Route('/anonymat', name: 'app_anonymat')]
    public function index(): Response
    {
        return $this->render('anonymat/index.html.twig', [
            'controller_name' => 'AnonymatController',
        ]);
    }


// Dans AnonymatController.php

#[Route('/anonymats/{ecId<\d+>}', name: 'attribuer_anonymats')]
public function attribuerAnonymats(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
{
    $ec = $entityManager->getRepository(EC::class)->find($ecId);
    if (!$ec) {
        throw $this->createNotFoundException('EC non trouvé');
    }

    $ue = $ec->getUe();
    $fields = $ue->getFields();

    $students = $entityManager->getRepository(Student::class)->findBy(['field' => $fields->toArray()]);

    $anonymatsData = ['anonymats' => []];
    foreach ($students as $student) {
        $anonymat = new Anonymat();
        $anonymat->setStudent($student);
        $anonymat->setEC($ec);
        $anonymatsData['anonymats'][] = $anonymat;
    }

    $form = $this->createForm(AnonymatCollectionType::class, $anonymatsData);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $anonymats = $form->getData()['anonymats'];
        foreach ($anonymats as $anonymat) {
            $entityManager->persist($anonymat);
        }
        $entityManager->flush();

        $this->addFlash('success', 'Les anonymats ont été attribués avec succès.');
        return $this->redirectToRoute('app_dashAdmin');
    }

    return $this->render('anonymat/attribuer.html.twig', [
        'form' => $form->createView(),
        'students' => $students,
        'ec' => $ec,
    ]);
}}
