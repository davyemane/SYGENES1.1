<?php

namespace App\Controller;

use App\Entity\RespField;
use App\Entity\User;
use App\Repository\FieldRepository;
use App\Repository\RespFieldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class RespFieldController extends AbstractController
{
    #[Route('/resp/field', name: 'app_resp_field')]
    public function index(): Response
    {
        return $this->render('resp_field/index.html.twig', [
            'controller_name' => 'RespFieldController',
        ]);
    }



    #[Route('/schooldashboard', name: 'admin_dashboard')]
    public function dashboard(FieldRepository $fieldRepository, RespFieldRepository $respFieldRepository): Response
    {
        $user = $this->getUser();
        $field = $fieldRepository->findAll();
        $respField = $respFieldRepository->findAll();
    
        return $this->render('admin_dashboard/index.html.twig', [
            'fields' => $field,
            'resp_fields' => $respField,
            'user'=>$user
        ]);
    }
   
    #[Route('/delete_resp_field/{id}', name: 'delete_resp_field')]
    public function deleteRespField(RespField $respField, EntityManagerInterface $entityManager): Response
    {
        try {
            $entityManager->beginTransaction();
    
            // Remove the association with Field
            $field = $respField->getField();
            if ($field) {
                $respField->setField(null);
            }
    
            // Récupérer l'utilisateur associé au RespField
            $userToDelete = $entityManager->getRepository(User::class)->findOneBy(['respfield' => $respField]);
            if ($userToDelete) {
                // Supprimer l'utilisateur
                $entityManager->remove($userToDelete);
            }
    
            // Remove the RespField
            $entityManager->remove($respField);
    
            // Apply changes
            $entityManager->flush();
            $entityManager->commit();
    
            $this->addFlash('success', 'The field responsible has been successfully deleted.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'An error occurred during deletion: ' . $e->getMessage());
        }
    
        return $this->redirectToRoute('admin_dashboard');
    }
}