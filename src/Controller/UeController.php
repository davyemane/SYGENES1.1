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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/ue')]
class UeController extends AbstractController
{
    // #[Route('/add/ue', name: 'add_ue')]
    // public function addUe(): Response
    // {
    //     $ue = new UE();
    //     $form =$this->createForm(UeType::class, $ue);
    //     return $this->render('ue/createUe.html.twig', ['form' => $form->createView()]);
    // }

    #[Route('/add/ec', name: 'add_ec')]
    public function addEc(): Response
    {
        $ec = new EC();
        $form =$this->createForm(EcType::class, $ec);
        return $this->render('ue/createEC.html.twig', ['form' => $form->createView()]);
    }



    #[Route('/add/ue/{id?0}', name: 'add_ue')]
    public function AddUe($id, ManagerRegistry $doctrine, Request $request): Response
    {
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
    
                return $this->redirectToRoute("app_home_page");
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur s\'est produite.');
                error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3, 'chemin/vers/votre/error.log');
                return $this->redirectToRoute('app_home_page');
            }
        }
    
        return $this->render('ue/createUe.html.twig', ['form' => $form->createView()]);
    }}