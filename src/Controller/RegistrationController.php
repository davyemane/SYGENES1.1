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
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        Security $security, 
        EntityManagerInterface $entityManager, 
        SluggerInterface $slugger,
        SessionInterface $session,
        RoleRepository $roleRepository
    ): Response
    {
        $user = new User();
        $responsable = new Responsable();
        $user->setResponsable($responsable);
    
        // Get the school from the session
        $schoolName = $session->get('school_name');
        $school = null;
        $schoolRoles = [];
    
        if ($schoolName) {
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
            if ($school) {
                $schoolRoles = $roleRepository->findBy(['school' => $school]);
            }
        }
    
        $form = $this->createForm(RegistrationFormType::class, $user, [
            'school_roles' => $schoolRoles, // Pass school roles to the form
        ]);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $this->handleProfilePictureUpload($form, $user, $slugger);
    
            // Encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
    
            // Set roles
            $selectedRoles = $form->get('role')->getData();
            foreach ($selectedRoles as $role) {
                $user->addRole($role);
            }
    
            // Set the email for the responsable
            $responsable->setEmail($user->getEmail());
            $session->clear();
            // Persist both User and Responsable
            $entityManager->persist($user);
            $entityManager->persist($responsable);
            $entityManager->flush();
    
            // Log the user in
            return $security->login($user, LoginAuthenticator::class, 'main');
        }
    
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'user' => $user,
            'school' => $school,
            'schoolRoles' => $schoolRoles
        ]);
    }
    
    private function handleProfilePictureUpload($form, $user, $slugger): void
    {
        /** @var UploadedFile $profilePictureFile */
        $profilePictureFile = $form->get('profilePicture')->getData();
    
        if ($profilePictureFile) {
            $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$profilePictureFile->guessExtension();
    
            try {
                $profilePictureFile->move(
                    $this->getParameter('profile_pictures_directory'),
                    $newFilename
                );
                $user->setProfilePicture($newFilename);
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
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
