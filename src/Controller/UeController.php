<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\UE;
use App\Form\EcType;
use App\Form\UeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/ue')]
class UeController extends AbstractController
{

    #[Route('/add/ec/{id?0}', name: 'add_ec')]
    public function AddEc($id, ManagerRegistry $doctrine, Request $request): Response
    {

        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $privileges = [];
        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
                if ($privilege->getName() === 'Add EC') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
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
    
        return $this->render('ue/createEC.html.twig', 
        ['form' => $form->createView(),
    'user' => $user,
    'privileges' => array_values($privileges) // Convertir en tableau indexé
    ]);
    }



    #[Route('/add/ue/{id?0}', name: 'add_ue')]
    public function AddUe($id, ManagerRegistry $doctrine, Request $request): Response
    {

        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
                if ($privilege->getName() === 'Add UE') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }        


        // Check if the user has ROLE_ADMIN
        $entityManager = $doctrine->getManager();
    
        // Vérifier si un ID de l'ue a été fourni
        if ($id) {
            $ue = $entityManager->getRepository(UE::class)->find($id);
        } else {
            $ue = new UE();
        }
    
        $form = $this->createForm(UeType::class, $ue);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($ue);
                $entityManager->flush();
    
                $message = $id ? 'mis à jour' : 'ajouté';
                $this->addFlash('success', $ue->getName() . " a été $message avec succès !");
    
                return $this->redirectToRoute("add_ue");
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur s\'est produite.');
                error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3, 'chemin/vers/votre/error.log');
                return $this->redirectToRoute('app_home_page');
            }
        }
    
        return $this->render('ue/createUe.html.twig', ['form' => $form->createView(), 'user' => $user,            
         'privileges' => array_values($privileges), // Convertir en tableau indexé
    ]);
    }


}