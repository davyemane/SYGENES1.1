<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\RespLevel;
use App\Entity\RespUe;
use App\Entity\School;
use App\Entity\UE;
use App\Entity\User;
use App\Form\EcType;
use App\Form\UeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/adminue')]
class UeController extends AbstractController
{

    #[Route('/add/ec/{id?0}', name: 'add_ec')]
    public function AddEc($id, ManagerRegistry $doctrine, Request $request): Response
    {

        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }



        $entityManager = $doctrine->getManager();

        // Vérifier si un ID de l'ue a été fourni
        if ($id) {
            $ec = $entityManager->getRepository(EC::class)->find($id);
        } else {
            $ec = new EC();
        }

        $form = $this->createForm(EcType::class, $ec);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($ec);
                $entityManager->flush();

                $message = $id ? 'mis à jour' : 'ajouté';
                $this->addFlash('success', $ec->getName() . " a été $message avec succès !");

                return $this->redirectToRoute("add_ec");
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur s\'est produite.');
                error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3, 'chemin/vers/votre/error.log');
                return $this->redirectToRoute('app_home_page');
            }
        }

        return $this->render(
            'ue/createEC.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }



    #[Route('/add/ue/{id<\d+>?0}', name: 'add_ue')]
    public function AddUe(
        EntityManagerInterface $entityManager,
        Request $request,
        int $id = 0
    ): Response {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupérer le RespLevel de l'utilisateur connecté
        $respLevel = $user->getRespLevel();
        if (!$respLevel) {
            throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour créer une UE.');
        }

        // Récupérer le Level associé au RespLevel
        $level = $respLevel->getLevel();
        if (!$level) {
            throw $this->createNotFoundException('Aucun niveau n\'est associé à ce responsable de niveau.');
        }

        // Récupérer toutes les UE du niveau actuel
        $existingUEs = $entityManager->getRepository(UE::class)->findBy(['level' => $level]);

        // Fetch or create UE
        $ue = $id
            ? $entityManager->getRepository(UE::class)->find($id)
            : new UE();

        if ($id && !$ue) {
            throw $this->createNotFoundException('UE not found');
        }

        $form = $this->createForm(UeType::class, $ue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Set the Level automatically
                $ue->setLevel($level);

                // Add the UE to all fields associated with the level
                foreach ($level->getField() as $field) {
                    $ue->addField($field);
                }

                $entityManager->persist($ue);
                $entityManager->flush();

                $message = $id ? 'mise à jour' : 'ajoutée';
                $this->addFlash('success', sprintf('L\'UE "%s" a été %s avec succès !', $ue->getName(), $message));

                return $this->redirectToRoute('add_ue');
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
                // Log the error
                error_log($e->getMessage());
            }
        }

        return $this->render('ue/createUe.html.twig', [
            'form' => $form->createView(),
            'ue' => $ue,
            'isEdit' => $id !== 0,
            'existingUEs' => $existingUEs, // Passer les UE existantes à la vue
        ]);
    }


    #[Route('/delete/ue/{id}', name: 'delete_ue')]
    public function deleteUe(
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        int $id
    ): Response {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        // Récupérer le RespLevel de l'utilisateur connecté
        $respLevel = $user->getRespLevel();
        if (!$respLevel) {
            throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour supprimer une UE.');
        }
    
        // Récupérer l'UE
        $ue = $entityManager->getRepository(UE::class)->find($id);
        if (!$ue) {
            throw $this->createNotFoundException('UE non trouvée');
        }
    
        // Vérifier si l'UE appartient au niveau du responsable
        if ($ue->getLevel() !== $respLevel->getLevel()) {
            throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour supprimer cette UE.');
        }
    
        try {
            // Récupérer et supprimer le RespUe associé
            $respUe = $entityManager->getRepository(RespUe::class)->findOneBy(['ue' => $ue]);
            if ($respUe) {
                // Récupérer l'utilisateur associé au RespUe
                $userToDelete = $entityManager->getRepository(User::class)->findOneBy(['respue' => $respUe]);
                if ($userToDelete) {
                    // Supprimer l'utilisateur
                    $entityManager->remove($userToDelete);
                }
                // Supprimer le RespUe
                $entityManager->remove($respUe);
            }
    
            // Supprimer l'UE de tous les champs associés
            foreach ($ue->getFields() as $field) {
                $ue->removeField($field);
            }
    
            // Supprimer les ECs associés à l'UE
            foreach ($ue->getECs() as $ec) {
                $entityManager->remove($ec);
            }
    
            // Supprimer l'UE
            $entityManager->remove($ue);
            $entityManager->flush();
    
            $this->addFlash('success', sprintf('L\'UE "%s", son responsable et le compte utilisateur associé ont été supprimés avec succès !', $ue->getName()));
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de la suppression de l\'UE, de son responsable et du compte utilisateur associé : ' . $e->getMessage());
            // Log the error
            $logger->error('Erreur lors de la suppression de l\'UE, de son responsable et du compte utilisateur associé', [
                'exception' => $e,
                'ue_id' => $id
            ]);
        }
    
        return $this->redirectToRoute('ue_dashboards');
    }
    
}
