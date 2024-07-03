<?php

namespace App\Controller;

use App\Service\ColorSchemeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ColorSchemeController extends AbstractController
{
    #[Route('/color/scheme', name: 'app_color_scheme')]
    public function index(): Response
    {
        return $this->render('color_scheme/index.html.twig', [
            'controller_name' => 'ColorSchemeController',
        ]);
    }

    #[Route('/update-colors', name: 'update_colors', methods: ['POST'])]
    public function updateColors(Request $request, ColorSchemeService $colorSchemeService): Response
    {
        $colors = $request->request->all();
        $colorSchemeService->updateColorScheme($colors);

        return $this->redirectToRoute('home');
    }
}
