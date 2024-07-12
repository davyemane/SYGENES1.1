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
    
            // 1. Trouver tous les utilisateurs liés à ce RespSchool
            $users = $entityManager->getRepository(User::class)->findBy(['respschool' => $respSchool]);
    
            // 2. Pour chaque utilisateur lié
            foreach ($users as $user) {
                // Supprimer toutes les relations de l'utilisateur
                $user->setRespschool(null);
                $user->setRespfield(null);
                $user->setResplevel(null);
                $user->setRespue(null);
                $user->setStudent(null);
                $user->setTeacher(null);
    
                // Supprimer l'utilisateur de la collection dans RespSchool
                $respSchool->removeRespSchool($user);
    
                // Supprimer l'utilisateur
                $entityManager->remove($user);
            }
    
            // 3. Supprimer toutes les relations de RespSchool
            $respSchool->setCreatedBy(null);
            $respSchool->setSchool(null);
    
            // 4. Supprimer le RespSchool
            $entityManager->remove($respSchool);
    
            // 5. Appliquer les changements
            $entityManager->flush();
            $entityManager->commit();
    
            $this->addFlash('success', 'Le responsable d\'école et les comptes utilisateurs associés ont été supprimés avec succès.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
        }
    
        return $this->redirectToRoute('resp_school');
    }}
