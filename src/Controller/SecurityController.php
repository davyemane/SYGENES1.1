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
        // Récupérer l'utilisateur connecté
        $user = $this->security->getUser();
    
        if (!$user) {
            // Si aucun utilisateur n'est connecté, rediriger vers la page d'accueil
            return $this->redirectToRoute('app_home');
        }
    
        // Récupérer les rôles de l'utilisateur
        $userRoles = $user->getRole();
    
        if ($userRoles->isEmpty()) {
            // Si l'utilisateur n'a pas de rôles, rediriger vers la page d'accueil
            return $this->redirectToRoute('app_home');
        }
    
        // Vérifier si l'utilisateur a le rôle "Student"
        $isStudent = $userRoles->exists(function($key, Role $role) {
            return $role->getName() === 'Student';
        });
    
        if ($isStudent) {
            return $this->redirectToRoute('app_dashStudent');
        } else {
            // Tous les autres rôles sont redirigés vers le dashboard Admin
            return $this->redirectToRoute('app_dashAdmin');
        }
    }}
