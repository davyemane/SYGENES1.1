<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RespECController extends AbstractController
{
    #[Route('/admin/respec', name: 'respec_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('admin_dashboard/teacher_dashboard.html.twig', [
            'controller_name' => 'RespECController',
            'user' => $user
        ]);
    }
}
