<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentNewController extends AbstractController
{
    #[Route('/student', name: 'student_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('admin_dashboard/student_dashboard.html.twig', [
            'controller_name' => 'StudentNewController',
            'user'=> $user
        ]);
    }
}
