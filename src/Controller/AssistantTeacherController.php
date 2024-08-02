<?php

namespace App\Controller;

use App\Entity\AssistantTeacher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AssistantTeacherController extends AbstractController
{
    #[Route('/admin/assistant_teacher', name: 'assistant_teacher_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        $assistant = $user->getAssistantTeacher();

        if (!$assistant) {
            throw $this->createNotFoundException('Assistant teacher not found for this user.');
        }

        $teacher = $assistant->getTeacher();

        if (!$teacher) {
            throw $this->createNotFoundException('Teacher not found for this assistant.');
        }

        $ecs = $teacher->getEcs();

        return $this->render('admin_dashboard/assistant_teacher.html.twig', [
            'controller_name' => 'AssistantTeacherController',
            'user' => $user,
            'assistant' => $assistant,
            'teacher' => $teacher,
            'ecs' => $ecs
        ]);
    }

    #[Route('/delete/assistant-teacher/{id}', name: 'delete_assistant_teacher', methods: ['DELETE'])]
public function deleteAssistantTeacher(int $id, EntityManagerInterface $entityManager): JsonResponse
{
        $assistantTeacher = $entityManager->getRepository(AssistantTeacher::class)->find($id);
    
        if (!$assistantTeacher) {
            return new JsonResponse(['message' => 'Assistant enseignant non trouvé'], Response::HTTP_NOT_FOUND);
        }
    
        // Vérifier si l'utilisateur actuel a les droits pour supprimer cet assistant
        $this->denyAccessUnlessGranted('DELETE', $assistantTeacher);
    
        $user = $assistantTeacher->getUser();
    
        if ($user) {
            // Supprimer d'abord l'assistant enseignant
            $entityManager->remove($assistantTeacher);
            $entityManager->flush();
    
            // Puis supprimer l'utilisateur associé
            $entityManager->remove($user);
        } else {
            // Si pas d'utilisateur associé, supprimer uniquement l'assistant enseignant
            $entityManager->remove($assistantTeacher);
        }
    
        $entityManager->flush();
    
        return new JsonResponse(['message' => 'Assistant enseignant et compte utilisateur associé supprimés avec succès'], Response::HTTP_OK);
    }
}
