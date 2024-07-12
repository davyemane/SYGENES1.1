<?php

namespace App\Controller;

use App\Entity\RespSchool;
use App\Entity\User;
use App\Repository\RespSchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]

class RespSchoolController extends AbstractController
{
    #[Route('/list_respschool', name: 'resp_school')]
    public function index(RespSchoolRepository $respSchoolRepository): Response
    {
        $respSchools = $respSchoolRepository->findAll();
    
        return $this->render('resp_school/index.html.twig', [
            'resp_schools' => $respSchools,
        ]);
    }
    
    #[Route('/delete_respschool/{id}', name: 'delete_resp_school')]
    public function delete(RespSchool $respSchool, EntityManagerInterface $entityManager): Response
    {
        try {
            $entityManager->beginTransaction();
    
            // 1. Trouver l'utilisateur lié à ce RespSchool
            $user = $entityManager->getRepository(User::class)->findOneBy(['respschool' => $respSchool]);
    
            if ($user) {
                // Supprimer la relation de l'utilisateur avec RespSchool
                $user->setRespschool(null);
                $entityManager->persist($user);
                $this->addFlash('info', 'Relation utilisateur-respschool supprimée.');
            } else {
                $this->addFlash('info', 'Aucun utilisateur trouvé pour ce RespSchool.');
            }
    
            // 2. Supprimer la relation de RespSchool avec User
            $respSchool->setCreatedBy(null);
            $entityManager->persist($respSchool);
            $this->addFlash('info', 'Relation respschool-user supprimée.');
    
            // 3. Supprimer le RespSchool
            $entityManager->remove($respSchool);
            $this->addFlash('info', 'RespSchool marqué pour suppression.');
    
            // 4. Appliquer les changements
            $entityManager->flush();
            $entityManager->commit();
    
            $this->addFlash('success', 'Le responsable d\'école a été supprimé avec succès.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
        }
    
        return $this->redirectToRoute('resp_school');
    }}
