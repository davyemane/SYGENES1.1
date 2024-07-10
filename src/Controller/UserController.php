<?php
// src/Controller/UserController.php
namespace App\Controller;

use App\Form\UserType;
use App\Form\PasswordChangeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
#[Route('/admin')]

class UserController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('user/profile/edit', name: 'app_profile_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $passwordChangeForm = $this->createForm(PasswordChangeType::class);


        $privileges = [];

        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
            }
        }


        $form->handleRequest($request);
        $passwordChangeForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traiter la photo de profil
            $profilePictureFile = $form->get('profilePicture')->getData();
            if ($profilePictureFile) {
                $newFilename = uniqid() . '.' . $profilePictureFile->guessExtension();
                try {
                    $profilePictureFile->move(
                        $this->getParameter('profile_pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception
                }
                $user->setProfilePicture($newFilename);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_show');
        }

        if ($passwordChangeForm->isSubmitted() && $passwordChangeForm->isValid()) {
            // Valider le mot de passe actuel
            $currentPassword = $passwordChangeForm->get('currentPassword')->getData();
            if (!$this->passwordHasher->isPasswordValid($user, $currentPassword)) {
                throw new AccessDeniedException('Le mot de passe actuel est incorrect.');
            }

            // Hacher et mettre à jour le mot de passe
            $newPassword = $passwordChangeForm->get('newPassword')->getData();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_show');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'passwordChangeForm' => $passwordChangeForm->createView(),
            "user" => $user,
            'privileges' => array_values($privileges), // Convertir en tableau indexé
        ]);
    }



    #[Route('user/profile', name: 'app_profile_show')]
    public function show(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $privileges = [];

        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
            }
        }

        // Load the Student entity if it exists
        $student = $user->getStudent();

        // if (!$student) {
        //     return $this->render('user/show.html.twig', [
        //         'user' => $user,
        //     ]);

        // }

        $template = $student ? 'base_StudentDashboard.html.twig' : 'base_new.html.twig';

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'student' => $student,
            'layout_template' => $template,
            'privileges' => array_values($privileges), // Convertir en tableau indexé
        ]);
    }
}
