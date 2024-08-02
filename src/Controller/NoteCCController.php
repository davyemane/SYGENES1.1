<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\Field;
use App\Entity\Level;
use App\Entity\NoteCcTp;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\UE;
use App\Repository\LevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('teacher')]

class NoteCCController extends AbstractController
{
    #[Route('/note/c/c', name: 'app_note_c_c')]
    public function index(): Response
    {
        return $this->render('note_cc/index.html.twig', [
            'controller_name' => 'NoteCCController',
        ]);
    }

    #[Route('/edit-note/{ecId}/{studentId}', name: 'edit_note', methods: ['GET'])]
    public function editNote(EntityManagerInterface $entityManager, int $ecId, int $studentId): Response
    {
        $user = $this->getUser();
        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        $student = $entityManager->getRepository(Student::class)->find($studentId);

        if (!$ec || !$student) {
            throw $this->createNotFoundException('EC ou étudiant non trouvé');
        }

        $noteCcTp = $entityManager->getRepository(NoteCcTp::class)->findOneBy([
            'student' => $student,
            'eC' => $ec
        ]);

        // Create a form for editing the note
        $form = $this->createFormBuilder($noteCcTp)
            ->add('cc', NumberType::class, ['required' => false])
            ->add('tp', NumberType::class, ['required' => false])
            ->add('hasTp', CheckboxType::class, ['required' => false])
            ->getForm();

        return $this->render('note_cc/edit_note.html.twig', [
            'form' => $form->createView(),
            'student' => $student,
            'ec' => $ec,
            'user' => $user
        ]);
    }

    #[Route('/insert-notes/{ecId}', name: 'insertNotesCc')]
    public function insertNotes(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {
        // Récupérer l'EC à partir de l'ID
        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        if (!$ec) {
            throw $this->createNotFoundException('EC non trouvé');
        }

        $user = $this->getUser();
        // Récupérer l'UE associée à cet EC
        $ue = $ec->getUe();
        if (!$ue) {
            throw $this->createNotFoundException('UE non trouvée pour cet EC');
        }

        // Récupérer le niveau associé à cette UE
        $levelId = $ue->getLevel()->getId();

        $level = $entityManager->getRepository(Level::class)->findBy(['id' => $levelId]);

        if (!$level) {
            throw $this->createNotFoundException('Niveau non trouvé pour cette UE');
        }

        // Récupérer la filière associée à ce niveau
        foreach ($level as $levels) {
            $level = $levels;
        }

        $fieldId = $level->getField()->getId();

        $field = $entityManager->getRepository(Field::class)->findBy(['id' => $fieldId]);

        foreach ($field as $fields) {
            $field = $fields;
        }

        if (!$field) {
            throw $this->createNotFoundException('Filière non trouvée pour ce niveau');
        }

        // Rechercher les étudiants correspondant à ce niveau et cette filière
        $students = $entityManager->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->where('s.field = :field')
            ->andWhere('s.level = :level')
            ->setParameter('field', $field)
            ->setParameter('level', $level)
            ->getQuery()
            ->getResult();

        // Créer le formulaire pour indiquer si l'EC a un TP
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
            ->add('ccMax', ChoiceType::class, [
                'choices' => array_combine(range(20, 100, 10), range(20, 100, 10)),
                'label' => 'Note maximale CC'
            ])
            ->add('tpMax', ChoiceType::class, [
                'choices' => array_combine(range(20, 100, 10), range(20, 100, 10)),
                'label' => 'Note maximale TP',
                'required' => false,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            $hasTp = $form->get('hasTp')->getData();
            $ccMax = $form->get('ccMax')->getData();
            $tpMax = $form->get('tpMax')->getData();
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
                if ($ccNote !== null) {
                    $ccNoteConverted = (floatval($ccNote) * 30) / $ccMax; // Conversion based on selected max CC points
                    $noteCcTp->setCc($ccNoteConverted);
                } else {
                    $noteCcTp->setCc(null);
                }

                if ($hasTp) {
                    $tpNote = $data['tp_' . $student->getId()] ?? null;
                    if ($tpNote !== null) {
                        $tpNoteConverted = (floatval($tpNote) * 20) / $tpMax; // Conversion based on selected max TP points
                        $noteCcTp->setTp($tpNoteConverted);
                    } else {
                        $noteCcTp->setTp(null);
                    }
                }

                $entityManager->persist($noteCcTp);
            }

            $entityManager->flush();

            return $this->redirectToRoute('insertNotesCc', ['ecId' => $ecId]);
        }

        return $this->render('note_cc/insert_notes.html.twig', [
            'form' => $form->createView(),
            'ec' => $ec,
            'students' => $students,
            'user' => $user,
            'ue' => $ue
        ]);
    }



    //affichage des notes de cc
    #[Route('/display-notes/{ecId}', name: 'displayNotesCc')]
    public function displayNotes(Request $request, EntityManagerInterface $entityManager, int $ecId): Response
    {
        // Récupérer l'EC à partir de l'ID
        $ec = $entityManager->getRepository(EC::class)->find($ecId);
        if (!$ec) {
            throw $this->createNotFoundException('EC non trouvé');
        }

        $user = $this->getUser();
        // Récupérer l'UE associée à cet EC
        $ue = $ec->getUe();
        if (!$ue) {
            throw $this->createNotFoundException('UE non trouvée pour cet EC');
        }

        // Récupérer le niveau associé à cette UE
        $level = $ue->getLevel();
        if (!$level) {
            throw $this->createNotFoundException('Niveau non trouvé pour cette UE');
        }

        // Récupérer la filière associée à ce niveau
        $field = $level->getField();
        if (!$field) {
            throw $this->createNotFoundException('Filière non trouvée pour ce niveau');
        }

        // Rechercher les étudiants correspondant à ce niveau et cette filière
        $students = $entityManager->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->where('s.field = :field')
            ->andWhere('s.level = :level')
            ->setParameter('field', $field)
            ->setParameter('level', $level)
            ->getQuery()
            ->getResult();

        // Récupérer les notes pour chaque étudiant
        $studentNotes = [];
        foreach ($students as $student) {
            $note = $entityManager->getRepository(NoteCcTp::class)->findOneBy([
                'student' => $student,
                'eC' => $ec
            ]);

            $studentNotes[] = [
                'student' => $student,
                'note' => $note
            ];
        }

        return $this->render('note_cc/display_notes.html.twig', [
            'ec' => $ec,
            'ue' => $ue,
            'studentNotes' => $studentNotes,
            'user' => $user
        ]);
    }

    #[Route('/cc/fields', name: 'cc_filieres')]
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

        return $this->render('note_cc/fields.html.twig', [
            'filieres' => $filieres,
            'user' => $user,
            'privileges' => $privileges

        ]);
    }

    #[Route('/cc/Fileds/{id}', name: 'cc_filiere_ues')]
    public function listUEsAndECs(Field $filiere, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        // Collect all unique privileges of the user
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Use ID as key to avoid duplicates
            }
        }
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
            'user' => $user,
            'uesWithECs' => $uesWithECs,
            'privileges' => $privileges
        ]);
    }
}
