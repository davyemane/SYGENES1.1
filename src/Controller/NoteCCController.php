<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\Field;
use App\Entity\NoteCcTp;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\UE;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NoteCCController extends AbstractController
{
    #[Route('/note/c/c', name: 'app_note_c_c')]
    public function index(): Response
    {
        return $this->render('note_cc/index.html.twig', [
            'controller_name' => 'NoteCCController',
        ]);
    }

    #[Route('/insert-notes/{ecId}', name: 'insert_notes_cc')]
    public function insertNotes(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {
        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        if (!$ec) {
            throw $this->createNotFoundException('EC non trouvé');
        }
    
        $user = $this->getUser();
        $ue = $ec->getUe();
        if (!$ue) {
            throw $this->createNotFoundException('UE non trouvée pour cet EC');
        }
    
        $fields = [];
        foreach ($ue->getFields() as $field) {
            $fields[] = $field->getId();
        }
    
        if (empty($fields)) {
            throw $this->createNotFoundException('Aucune filière trouvée pour cette UE');
        }
    
        $students = $entityManager->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->where('s.field IN (:fields)')
            ->setParameter('fields', $fields)
            ->getQuery()
            ->getResult();
    
        $form = $this->createFormBuilder()
            ->add('hasTp', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Cet EC a-t-il un TP ?'
            ])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($request->isMethod('POST')) {
            $hasTp = $form->get('hasTp')->getData();
            $ec->setHasTp($hasTp);
            
            $data = $request->request->all();
            $now = new \DateTime();
            $user = $this->getUser();
    
            foreach ($students as $student) {
                $existingNote = $entityManager->getRepository(NoteCcTp::class)->findOneBy([
                    'student' => $student,
                    'eC' => $ec
                ]);
    
                if ($existingNote) {
                    $noteCcTp = $existingNote;
                } else {
                    $noteCcTp = new NoteCcTp();
                    $noteCcTp->setEC($ec);
                    $noteCcTp->setStudent($student);
                    $noteCcTp->setCreatedAt($now);
                    $noteCcTp->setCreatebBy($user);
                }
    
                $noteCcTp->setHasTp($hasTp);
    
                $ccNote = $data['cc_' . $student->getId()] ?? null;
                $noteCcTp->setCc($ccNote ? floatval($ccNote) : null);
    
                if ($hasTp) {
                    $tpNote = $data['tp_' . $student->getId()] ?? null;
                    $noteCcTp->setTp($tpNote ? floatval($tpNote) : null);
                } else {
                    $noteCcTp->setTp(null);
                }
    
                if (!$existingNote) {
                    $entityManager->persist($noteCcTp);
                }
            }
    
            $entityManager->flush();
    
            $this->addFlash('success', 'Les notes ont été enregistrées avec succès.');
            return $this->redirectToRoute('insert_notes', ['ecId' => $ecId]);
        }
    

return $this->render('note_cc/insert_notes.html.twig', [
    'ec' => $ec,
    'user' =>$user,
    'ue' => $ue,
    'field' => $ue->getFields()->first(), // Prend la première filière associée à l'UE
    'students' => $students,
    'form' => $form->createView(),
]);    }


#[Route('/cc/fields', name: 'cc_filieres')]
public function listFilieres(Request $request, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();
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

    return $this->render('note_cc/fields.html.twig', [
        'filieres' => $filieres,
        'user' =>$user,

    ]);
}

#[Route('/cc/Fileds/{id}', name: 'cc_filiere_ues')]
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

    return $this->render('note_cc/ues_ecs.html.twig', [
        'filiere' => $filiere,
        'user' =>$user,
        'uesWithECs' => $uesWithECs,
    ]);
}

}