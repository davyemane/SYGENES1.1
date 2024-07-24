<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AssistantTeacherController extends AbstractController
{
    #[Route('/admin/assistant_teacher', name: 'assistant_teacher_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('admin_dashboard/assistant_teacher.html.twig', [
            'controller_name' => 'AssistantTeacherController',
            'user' => $user
        ]);
    }
}
