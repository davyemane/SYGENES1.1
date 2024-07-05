<?php
// src/Controller/RoleController.php
namespace App\Controller;

use App\Entity\Role;
use App\Entity\School;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/role')]
class RoleController extends AbstractController
{
    #[Route('/new/{id?0}', name: 'role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, RoleRepository $roleRepository, SessionInterface $session, int $id = 0): Response
    {
        // Récupérer le nom de l'école depuis la session
        $schoolName = $session->get('school_name');
        $school = null;
        $existingRoles = [];
    
        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
            if ($school) {
                // Récupérer tous les rôles existants pour cette école
                $existingRoles = $roleRepository->findBy(['school' => $school]);
            }
        }
    
        // Trouver ou créer un nouveau rôle
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
    
        // Créer et gérer le formulaire
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if ($school) {
                $role->setSchool($school); // Assigner l'école au rôle
            }
    
            // Ajouter les privilèges au rôle
            $privileges = $role->getPrivileges();
            foreach ($privileges as $privilege) {
                $role->addPrivilege($privilege);
            }
    
            // Persister le rôle
            if (!$role->getId()) {
                $entityManager->persist($role);
            }
            $entityManager->flush();
    
            // Ajouter un message flash de succès
            $this->addFlash('success', $id > 0 ? 'Le rôle a été mis à jour avec succès.' : 'Le rôle a été créé avec succès.');
            return $this->redirectToRoute('role_new');
        }
    

        $colorScheme = [
            'primaryColor' => '#3490dc', // Bleu vif pour la couleur principale
            'secondaryColor' => '#ffed4a', // Jaune doré pour la couleur secondaire
            'accentColor' => '#e3342f', // Rouge vif pour les accents
            'backgroundColor' => '#f8fafc', // Blanc cassé pour l'arrière-plan
            'textColor' => '#2d3748' // Gris foncé pour le texte
        ];


        return $this->render('role/new.html.twig', [
            'role' => $role,
            'form' => $form,
            'isNew' => $id === 0,
            'existingRoles' => $existingRoles,
            'color_scheme'=>$colorScheme,

        ]);
    }}
