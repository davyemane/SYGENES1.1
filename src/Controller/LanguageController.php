<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LanguageController extends AbstractController
{
    #[Route('/language', name: 'language_choice')]
    public function index(): Response
    {
        return $this->render('language/index.html.twig');
    }

    #[Route('/change-language/{locale}', name: 'change_language')]
    public function setLanguage(string $lang, SessionInterface $session, Request $request): Response
    {
        $request->getSession()->set('_locale', $lang);

        return $this->redirect($request->headers->get('referer'));
    }
}
