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
#[Route('/admin')]

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
    $user = $this->getUser();
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
        return $this->redirectToRoute('respue_dashboard');
    }

    return $this->render('anonymat/attribuer.html.twig', [
        'form' => $form->createView(),
        'students' => $students,
        'ec' => $ec,
        'user' =>$user,
    ]);
}

#[Route('/anonymats/view/{ecId<\d+>}', name: 'voir_anonymats')]
public function voirAnonymats(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
{
    $user = $this->getUser();
    $ec = $entityManager->getRepository(EC::class)->find($ecId);
    if (!$ec) {
        throw $this->createNotFoundException('EC non trouvé');
    }

    // Récupérer les anonymats associés à cet EC
    $anonymats = $entityManager->getRepository(Anonymat::class)->findBy(['eC' => $ec]);

    return $this->render('anonymat/voir.html.twig', [
        'anonymats' => $anonymats,
        'ec' => $ec,
        'user' => $user,
    ]);
}

}
