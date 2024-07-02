<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    private $authorizationChecker;
    private $security;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker, Security $security)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->security = $security;
    }


    #[Route('/access-denied', name: 'access_denied')]
    public function accessDenied(): Response
    {
        return $this->render('security/access_denied.html.twig', [
            'message' => 'Access Denied'
        ], new Response('', Response::HTTP_FORBIDDEN));
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/redirect', name: 'app_redirect')]
    public function redirectUser(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->security->getUser();

        // Vérification des rôles et redirection en conséquence
        if ($this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashSuperAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_AATP', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_AAT', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_RPA', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_TEACHER', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_CEP', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_SA', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashAdmin'));
        }
        if ($this->authorizationChecker->isGranted('ROLE_USER', $user)) {
            return new RedirectResponse($this->generateUrl('app_dashStudent'));
            dump($user);
        }

        // Redirection par défaut si aucun rôle spécifique n'est trouvé
        return new RedirectResponse($this->generateUrl('app_home'));
    }
}
