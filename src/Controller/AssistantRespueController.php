<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AssistantRespueController extends AbstractController
{
    #[Route('/assistant/respue', name: 'app_assistant_respue')]
    public function index(): Response
    {
        return $this->render('assistant_respue/index.html.twig', [
            'controller_name' => 'AssistantRespueController',
        ]);
    }
}
