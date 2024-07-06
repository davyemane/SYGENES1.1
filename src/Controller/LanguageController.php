<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    #[Route('/language', name: 'language_choice')]
    public function index(): Response
    {
        return $this->render('language/index.html.twig');
    }

    #[Route('/language/{locale}', name: 'change_language')]
    public function changeLanguage(Request $request, string $locale): Response
    {
        $request->getSession()->set('_locale', $locale);

        $referer = $request->headers->get('referer');
        return $referer ? $this->redirect($referer) : $this->redirectToRoute('app_home_page');
    }
}
