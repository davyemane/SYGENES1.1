<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/role')]
class RoleController extends AbstractController
{
    #[Route('/new/{id?0}', name: 'role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id = 0): Response
    {
        if ($id > 0) {
            $role = $entityManager->getRepository(Role::class)->find($id);
            if (!$role) {
                throw $this->createNotFoundException('Rôle non trouvé');
            }
        } else {
            $role = new Role();
            $role->setCreatedAt(new \DateTime());
        }
    
        $role->setUpdatedAt(new \DateTime());
    
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$role->getId()) {
                $entityManager->persist($role);
            }
            $entityManager->flush();
    
            $this->addFlash('success', $id > 0 ? 'Le rôle a été mis à jour avec succès.' : 'Le rôle a été créé avec succès.');
            return $this->redirectToRoute('field_new');
        }
    
        return $this->render('role/new.html.twig', [
            'role' => $role,
            'form' => $form,
            'isNew' => $id === 0
        ]);
    }
}