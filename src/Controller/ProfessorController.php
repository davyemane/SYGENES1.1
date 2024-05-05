<?php

namespace App\Controller;

use App\Entity\Prefessor;
use App\Form\ProfessorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/professor')]
class ProfessorController extends AbstractController
{
    #[Route('/add', name: 'add_professor')]
    public function addProfessor(): Response
    {
        $professor = new Prefessor();
        $form = $this->createForm(ProfessorType::class, $professor);
        return $this->render('professor/registration.html.twig', ['form' => $form->createView()]);
    }
}
