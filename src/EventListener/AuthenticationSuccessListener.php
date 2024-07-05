<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\School;

class AuthenticationSuccessListener
{
    private $session;
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager, private RequestStack $requestStack,
    )
    {
        
        $this->entityManager = $entityManager;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $session = $this->requestStack->getSession();

        $user = $event->getAuthenticationToken()->getUser();
        
        // Récupérer les rôles de l'utilisateur
        $roles = $user->getRole();
        
        foreach ($roles as $role) {
            $school = $role->getSchool();
            if ($school !== null) {
                // Stocker le nom de l'école en session
                $session->set('school_name', $school->getName());
                break; // On prend la première école trouvée
            }
        }
    }
}