<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Entity\School;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\RoleRepository;
use App\Security\EmailVerifier;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, RoleRepository $roleRepository, SessionInterface $session, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        // Récupération de l'école et des rôles existants
        $schoolName = $session->get('school_name');
        $school = null;
        $existingRoles = [];

        if ($schoolName) {
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
            if ($school) {
                $existingRoles = $roleRepository->findBy(['school' => $school]);
            }
        }

        // Création des objets User et Responsable
        $user = new User();
        $responsable = new Responsable();
        $user->setResponsable($responsable);

        // Création et gestion du formulaire
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'upload de la photo de profil
            $this->handleProfilePictureUpload($form, $user, $slugger);

            // Encodage du mot de passe
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Attribution des rôles
            foreach ($existingRoles as $role) {
                $user->addRole($role);
            }

            // Persistance des entités
            $entityManager->persist($user);
            $entityManager->persist($responsable);
            $entityManager->flush();

            // Connexion de l'utilisateur
            return $security->login($user, LoginAuthenticator::class, 'main');
        }
        // Définition du schéma de couleurs
        $colorScheme = [
            'primaryColor' => '#3490dc',
            'secondaryColor' => '#e3342f',
            'accentColor' => '#e3342f',
            'backgroundColor' => '#e3342f',
            'textColor' => '#e3342f'
        ];

        // Rendu de la vue
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'user' => $user,
            'color_scheme' => $colorScheme,
            'school' => $school,
            'existingRoles' => $existingRoles
        ]);
    }

    // Méthode privée pour gérer l'upload de la photo de profil
    private function handleProfilePictureUpload($form, $user, $slugger): void
    {
        /** @var UploadedFile $profilePictureFile */
        $profilePictureFile = $form->get('profilePicture')->getData();

        if ($profilePictureFile) {
            $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $profilePictureFile->guessExtension();

            try {
                $profilePictureFile->move(
                    $this->getParameter('profile_pictures_directory'),
                    $newFilename
                );
                $user->setProfilePicture($newFilename);
            } catch (FileException $e) {
                // Gérer l'exception si quelque chose se passe mal pendant l'upload du fichier
            }
        }
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('list_student');
    }
}
