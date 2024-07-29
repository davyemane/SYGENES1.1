<?php

namespace App\Controller;

use App\Entity\Role;
use App\Repository\PrivilegeRepository;
use App\Repository\RoleRepository;
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


        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/redirect', name: 'app_redirect')]
    public function redirectUser(): Response
    {
        if (!$this->security->getUser()) {
            // Si aucun utilisateur n'est connecté, rediriger vers la page d'accueil
            return $this->redirectToRoute('app_home');
        }

        

        // Vérifier les rôles en utilisant isGranted(), du plus élevé au plus bas
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('super_admin_dashboard');
        } elseif ($this->security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_dashboard');
        } elseif ($this->security->isGranted('ROLE_RESPSCHOOL')) {
            return $this->redirectToRoute('admin_dashboard');
        } elseif ($this->security->isGranted('ROLE_RESPFIELD')) {
            return $this->redirectToRoute('level_dashboard');
        } elseif ($this->security->isGranted('ROLE_RESPLEVEL')) {
            return $this->redirectToRoute('ue_dashboards');
        } elseif ($this->security->isGranted('ROLE_RESPUE')) {
            return $this->redirectToRoute('respue_dashboard');
        } elseif ($this->security->isGranted('ROLE_TEACHER')) {
            return $this->redirectToRoute('teacher_ec_dashboard');
        } elseif ($this->security->isGranted('ROLE_STUDENT')) {
            return $this->redirectToRoute('app_dashStudent');
        } else {
            // Si aucun rôle correspondant n'est trouvé, rediriger vers la page d'accueil
            return $this->redirectToRoute('app_home');
        }
    }}
