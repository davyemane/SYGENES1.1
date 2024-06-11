<?php

namespace App\EventListener;

use App\Event\AddStudentEvent;
use Psr\Log\LoggerInterface;

class StudentListener
{

    public function __construct(private LoggerInterface $logger)
    {
        
    }

    public function onAddStudent(AddStudentEvent $event){
        $this->logger->debug("l'etudiant ".$event->getStudent()->getName()." vient d'etre activé ");
    }
}