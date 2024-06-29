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

    #[Route('/add/ec/{id?0}', name: 'add_ec'),
    IsGranted('ROLE_ADMIN')]
    public function AddEc($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $user = $this->getUser();
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
    
        return $this->render('ue/createEC.html.twig', ['form' => $form->createView(),
    'user' => $user]);
    }



    #[Route('/add/ue/{id?0}', name: 'add_ue'),
    IsGranted('ROLE_ADMIN')]
    public function AddUe($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $user = $this->getUser();
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
    
        return $this->render('ue/createUe.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }


        // List of all UEs with error handling
//         #[Route('/list/{page?1}/{nbre?16}', name: 'list_ue')
//         ]
//         public function home(ManagerRegistry $doctrine, $page, $nbre): Response
//         {
//             try {
//                 $repository = $doctrine->getRepository(UE::class);
    
//                 // Calculate total ue and number of pages
//                 $nbUe = $repository->count([]);
//                 $nbPage = ceil($nbUe / $nbre);
    
//                 // Fetch ue with pagination (handle potential errors)
//                 $ue = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);
//                 if (!$ue) {
//                     // Handle case where no ue are found
//                     throw new NotFoundHttpException('No ue found.');
//                 }
    
//                 return $this->render("ue/list.html.twig", [
//                     'ue' => $ue,
//                     'isPaginated' => true,
//                     'nbPage' => $nbPage,
//                     'page' => $page,
//                     'nbre' => $nbre
//                 ]);
//             } catch (NotFoundHttpException $e) {
//                 // Handle the specific case of not finding ue
//                 $this->addFlash('error', 'No ue found.');
//                 return $this->redirectToRoute('list_ue', ['page' => 1]); // Redirect to first page
//             } catch (\Exception $e) {
//                 // Catch other unexpected exceptions for broader error handling
//                 $this->addFlash('error', 'An error occurred.'); // Generic error message
//                 // Log the error for further investigation
//                 error_log($e->getMessage() . "\n" . $e->getTraceAsString(), 3, 'path/to/your/error.log'); // Replace with your log path
//                 return $this->redirectToRoute('list_ue', ['page' => 1]); // Redirect to first page
//             }
//         }
    
}