<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\School;
use App\Entity\User;

class AuthenticationSuccessListener
{
    private $entityManager;
    private $requestStack;

    public function __construct(
        EntityManagerInterface $entityManager,
        RequestStack $requestStack
    ) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $session = $this->requestStack->getSession();

        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();

        $school = null;

        // Vérifier si l'utilisateur est un RespSchool
        if ($user->getRespschool()) {
            $school = $user->getRespschool()->getSchool();
        } 
        // Vérifier si l'utilisateur est un RespField
        elseif ($user->getRespfield()) {
            $school = $user->getRespfield()->getField()->getSchool();
        }
        // Vérifier si l'utilisateur est un RespLevel
        elseif ($user->getResplevel()) {
            $school = $user->getResplevel()->getLevel()->getField()->getSchool();
        }
        // Vérifier si l'utilisateur est un RespUe
        elseif ($user->getRespue()) {
            $school = $user->getRespue()->getUe()->getLevel()->getField()->getSchool();
        }
        // Vérifier si l'utilisateur est un Teacher
        elseif ($user->getTeacher()) {
            // Supposons que Teacher ait une relation avec School
            $school = $user->getTeacher()->getSchool();
        }
        // Vérifier si l'utilisateur est un Student
        elseif ($user->getStudent()) {
            $school = $user->getStudent()->getLevel()->getField()->getSchool();
        }

        if ($school !== null) {
            // Stocker le nom de l'école en session
            $session->set('school_name', $school->getName());
            // Vous pouvez également stocker l'ID de l'école si nécessaire
            $session->set('school_id', $school->getId());
        }
    }
}