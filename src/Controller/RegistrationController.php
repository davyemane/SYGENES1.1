<?php
namespace App\Controller;

use App\Entity\Responsable;
use App\Entity\RespSchool;
use App\Entity\School;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RespSchoolType;
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
use App\Repository\SchoolRepository;

use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
#[Route('/admin')]

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
            foreach ($schoolRoles as $role) {
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
            'existingRoles' => $schoolRoles
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

    
    #[Route('/register/respschool/{id<\d+>?0}', name: 'new_school_resp')]
    public function manageRespSchool(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager, 
        SchoolRepository $schoolRepository,
        Security $security,
        $id
    ): Response
    {
        $isEdit = false;
        if ($id) {
            $isEdit = true;
        }
    
        if ($isEdit) {
            $user = $entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                throw $this->createNotFoundException('Utilisateur non trouvé');
            }
            $respSchool = $user->getRespSchool();
            if (!$respSchool) {
                $respSchool = new RespSchool();
                $user->setRespSchool($respSchool);
            }
        } else {
            $user = new User();
            $respSchool = new RespSchool();
        }
    
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->add('respSchool', RespSchoolType::class);
    
        if ($isEdit) {
            $form->remove('plainPassword');
        }
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$isEdit) {
                // Encode the password only for new users
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setRoles(['ROLE_ADMIN']);
                $respSchool->setCreatedAt(new \DateTime());
                
                // Set the creator as the currently logged-in user
                $currentUser = $security->getUser();
                if ($currentUser) {
                    $respSchool->setCreatedBy($currentUser);
                } else {
                    return $this->redirectToRoute('app_login');
                }
            }
    
            $email = $form->get('email')->getData();
            $user->setEmail($email);
    
            // Set RespSchool data
            $respSchool->setName($form->get('respSchool')->get('name')->getData());
            $respSchool->setCni($form->get('respSchool')->get('cni')->getData());
            $respSchool->setPhoneNumber($form->get('respSchool')->get('phone_number')->getData());
            $respSchool->setEmail($email);
            
            // Set the school
            $school = $schoolRepository->find($form->get('respSchool')->get('school')->getData());
            $respSchool->setSchool($school);
    
            // Link User and RespSchool
            $user->setRespSchool($respSchool);
    
            // Save to database
            $entityManager->persist($user);
            $entityManager->persist($respSchool);
            $entityManager->flush();
    
            // Redirect or render success message
            return $this->redirectToRoute('some_success_route');
        }
    
        return $this->render('resp_school/register_respschool.html.twig', [
            'registrationForm' => $form->createView(),
            'isEdit' => $isEdit,
        ]);
    }
}
