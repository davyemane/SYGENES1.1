<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LocaleController extends AbstractController
{
     
    #[Route("/change_locale/{locale}", name:"change_locale")]
    public function changeLocale($locale, Request $request, SessionInterface $session)
    {
        // Save the locale in the session
        $session->set('_locale', $locale);

        // Redirect to the previous page
       // $referer = $request->headers->get('referer');
        //return new RedirectResponse($referer ?: $this->generateUrl('homepage'));

        //
        return $this->redirectToRoute('language_choice');
    }
}
