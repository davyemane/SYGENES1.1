<?php

namespace App\Controller;

use App\Entity\AnonymatRattrapage;
use App\Entity\EC;
use App\Entity\Field;
use App\Entity\Rattrapage;
use App\Entity\School;
use App\Entity\UE;
use App\Form\RattrapageCollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/admin')]

class RattrapageController extends AbstractController
{
    #[Route('/rattrapage', name: 'app_rattrapage')]
    public function index(): Response
    {
        return $this->render('rattrapage/index.html.twig', [
            'controller_name' => 'RattrapageController',
        ]);
    }

    #[Route('/rattrapage/{ecId<\d+>}', name: 'inserer_notes_rattrapage')]
    public function insererNotesRattrapage(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {        // Récupérer la session de l'utilisateur
        $session = $request->getSession();
        $schoolName = $session->get('school_name');
        $user = $this->getUser();
        // Collect all unique privileges of the user
        $privileges = [];
        foreach ($user->getRole() as $role) {
        foreach ($role->getPrivileges() as $privilege) {
            $privileges[$privilege->getId()] = $privilege; // Use ID as key to avoid duplicates
        }
    }
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

        $anonymatsRattrapage = $entityManager->getRepository(AnonymatRattrapage::class)->findBy(['eC' => $ec]);

        $rattrapageData = ['rattrapages' => []];
        foreach ($anonymatsRattrapage as $anonymatRattrapage) {
            $rattrapage = new Rattrapage();
            $rattrapage->setAnonymatRattrapage($anonymatRattrapage);
            $rattrapage->setCreatedBy($this->getUser());
            $rattrapage->setCreatedAt(new \DateTime());
            $rattrapageData['rattrapages'][] = $rattrapage;
        }

        $form = $this->createForm(RattrapageCollectionType::class, $rattrapageData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rattrapages = $form->getData()['rattrapages'];
            $totalPoints = $form->get('totalPoints')->getData();

            foreach ($rattrapages as $rattrapage) {
                $originalMark = $rattrapage->getMark();
                if ($originalMark > $totalPoints) {
                    $this->addFlash('error', 'Une note dépasse le maximum autorisé.');
                    return $this->redirectToRoute('inserer_notes_rattrapage', ['ecId' => $ecId]);
                }

                // Convertir la note sur 20
                $convertedMark = ($originalMark / $totalPoints) * 20;
                $rattrapage->setMark($convertedMark);

                // Calculer et définir le grade (exemple simplifié)
                $grade = $this->calculateGrade($convertedMark);
                $rattrapage->setGrade($grade);

                $entityManager->persist($rattrapage);
            }
            $entityManager->flush();

            $this->addFlash('success', 'Les notes de rattrapage ont été insérées avec succès.');
            return $this->redirectToRoute('app_dashAdmin');
        }

        return $this->render('rattrapage/notes.html.twig', [
            'form' => $form->createView(),
            'rattrapages' => $rattrapageData['rattrapages'],
            'anonymatsRattrapage' => $anonymatsRattrapage,
            'ec' => $ec,
            'ue' => $ue,
            'fieldName' => $fieldName,
            'user' =>$user,
            'privileges' => $privileges
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


    #[Route('/rattrapage/fields', name: 'rattrapage_filieres')]
    public function listFilieres(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        // Collect all unique privileges of the user
        $privileges = [];
        foreach ($user->getRole() as $role) {
        foreach ($role->getPrivileges() as $privilege) {
            $privileges[$privilege->getId()] = $privilege; // Use ID as key to avoid duplicates
        }
    }
        $session = $request->getSession();
        $schoolName = $session->get('school_name');

        if (!$schoolName) {
            throw $this->createAccessDeniedException('Aucune école sélectionnée dans la session.');
        }

        $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        if (!$school) {
            throw $this->createNotFoundException('École non trouvée.');
        }

        $filieres = $entityManager->getRepository(Field::class)->findBy(['school' => $school]);

        return $this->render('rattrapage/fields.html.twig', [
            'filieres' => $filieres,
            'user' =>$user,
            'privileges' => $privileges,
        ]);
    }

    #[Route('/rattrapage/Fileds/{id}', name: 'rattrapage_filiere_ues')]
    public function listUEsAndECs(Field $filiere, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $ues = $entityManager->createQueryBuilder()
            ->select('u')
            ->from(UE::class, 'u')
            ->innerJoin('u.fields', 'f')
            ->where('f.id = :filiereId')
            ->setParameter('filiereId', $filiere->getId())
            ->getQuery()
            ->getResult();
    
        $uesWithECs = [];
        foreach ($ues as $ue) {
            $ecs = $entityManager->getRepository(EC::class)->findBy(['ue' => $ue]);
            $uesWithECs[] = [
                'ue' => $ue,
                'ecs' => $ecs,
            ];
        }
    
        return $this->render('rattrapage/ues_ecs.html.twig', [
            'filiere' => $filiere,
            'uesWithECs' => $uesWithECs,
            'user' =>$user,

        ]);
    }
}