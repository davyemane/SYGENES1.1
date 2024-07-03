<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/get-translations/{locale}', name: 'get_translations')]
    public function getTranslations(string $locale): JsonResponse
    {
        $translator = $this->get('translator');
        $translator->setLocale($locale);

        $translations = [
            'message' => $translator->trans('message'),
            'english-language' => $translator->trans('english-language'),
            'french-language' => $translator->trans('french-language'),
            'spanish-language' => $translator->trans('spanish-language'),
            'next' => $translator->trans('next'),
        ];

        return new JsonResponse($translations);
    }


}
