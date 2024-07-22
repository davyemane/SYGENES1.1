<?php

namespace App\Controller;

use App\Entity\Field;
use App\Entity\RespField;
use App\Entity\RespLevel;
use App\Entity\Responsable;
use App\Entity\RespSchool;
use App\Entity\RespUe;
use App\Entity\School;
use App\Entity\Teacher;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RespFieldType;
use App\Form\RespLevelType;
use App\Form\RespSchoolType;
use App\Form\RespUeType;
use App\Form\TeacherType;
use App\Repository\ECRepository;
use App\Repository\FieldRepository;
use App\Repository\LevelRepository;
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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\SchoolRepository;
use App\Repository\UERepository;
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
    ): Response {
        $user = new User();

        // // Get the school from the session
        // $schoolName = $session->get('school_name');
        // $school = null;
        // $schoolRoles = [];

        // if ($schoolName) {
        //     $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        //     if ($school) {
        //         $schoolRoles = $roleRepository->findBy(['school' => $school]);
        //     }
        // }

        $form = $this->createForm(RegistrationFormType::class, $user);
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

            // Set the email for the responsable
            // Persist both User and Responsable
            $entityManager->persist($user);
            $entityManager->flush();

            // Log the user in
            return $security->login($user, LoginAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'user' => $user,
        ]);
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




    //creation du responsable de l'etablissement 
    #[Route('/register/respschool/{id<\d+>?0}', name: 'new_school_resp')]
    public function manageRespSchool(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        SchoolRepository $schoolRepository,
        Security $security,
        SluggerInterface $slugger,
        $id
    ): Response {
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
            $this->handleProfilePictureUpload($form, $user, $slugger);

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


            if ($isEdit) {
                $this->addFlash('success', 'School Responsible information has been successfully updated.');
            } else {
                $this->addFlash('success', 'School Responsible has been successfully registered.');
            }

            // Redirect or render success message
            return $this->redirectToRoute('new_school_resp');
        }

        return $this->render('resp_school/register_respschool.html.twig', [
            'registrationForm' => $form->createView(),
            'isEdit' => $isEdit,
        ]);
    }


//add or modify RespFiléld
    #[Route('/register/respfield/{id<\d+>?0}', name: 'app_register_respfield')]
    public function manageRespField(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        FieldRepository $fieldRepository,
        Security $security,
        SluggerInterface $slugger,
        $id
    ): Response {
        $isEdit = false;
        if ($id) {
            $isEdit = true;
        }

        if ($isEdit) {
            $user = $entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                throw $this->createNotFoundException('Utilisateur non trouvé');
            }
            $respField = $user->getRespFields();
            if (!$respField) {
                $respField = new RespField();
                $user->setRespfield($respField);
            }
        } else {
            $user = new User();
            $respField = new RespField();
        }

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->add('respField', RespFieldType::class);

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
                $user->setRoles(['ROLE_RESPFIELD']);
                $respField->setCreatedAt(new \DateTime());

                // Set the creator as the currently logged-in user
                $currentUser = $security->getUser();
                if ($currentUser) {
                    $respField->setCreatedBy($currentUser);
                } else {
                    return $this->redirectToRoute('app_login');
                }
            }
            $this->handleProfilePictureUpload($form, $user, $slugger);

            $email = $form->get('email')->getData();
            $user->setEmail($email);

            // Set RespSchool data
            $respField->setName($form->get('respField')->get('name')->getData());
            $respField->setCni($form->get('respField')->get('cni')->getData());
            $respField->setPhoneNumber($form->get('respField')->get('phone_number')->getData());
            $respField->setEmail($email);

            // Set the school
            $field = $fieldRepository->find($form->get('respField')->get('field')->getData());
            $respField->setField($field);

            // Link User and RespSchool
            $user->setRespfield($respField);

            // Save to database
            $entityManager->persist($user);
            $entityManager->persist($respField);
            $entityManager->flush();


            if ($isEdit) {
                $this->addFlash('success', 'Field Responsible information has been successfully updated.');
            } else {
                $this->addFlash('success', 'Field Responsible has been successfully registered.');
            }
            
            // Redirect or render success message
            return $this->redirectToRoute('app_register_respfield');
        }

        return $this->render('resp_field/register_respfield.html.twig', [
            'registrationForm' => $form->createView(),
            'isEdit' => $isEdit,
        ]);
    }


    #[Route('/register/resplevel/{id<\d+>?0}', name: 'app_register_resplevel')]
    public function manageRespLevel(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        LevelRepository $levelRepository,
        Security $security,
        SluggerInterface $slugger,
        $id
    ): Response {
        // Vérifier si l'utilisateur connecté est un ROLE_RESPFIELD
        $currentUser = $security->getUser();
        if (!$currentUser || !in_array('ROLE_RESPFIELD', $currentUser->getRoles())) {
            throw $this->createAccessDeniedException('Access denied. You must be a ROLE_RESPFIELD.');
        }

        // Obtenir la filière du RESPFIELD connecté
        $respField = $currentUser->getRespField();
        $entityManager->refresh($respField);  // Rafraîchir l'entité depuis la base de données
        $respFieldField = $respField->getField();
        
        if (!$respFieldField) {
            throw $this->createNotFoundException('No field found for the connected RESPFIELD.');
        }

        // Détacher l'entité Field pour éviter les conflits
        $entityManager->detach($respFieldField);
        
        // Recharger l'entité Field
        $respFieldField = $entityManager->find(Field::class, $respFieldField->getId());

        $isEdit = false;
        if ($id) {
            $isEdit = true;
        }

        if ($isEdit) {
            $user = $entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                throw $this->createNotFoundException('Utilisateur non trouvé');
            }
            $respLevel = $user->getRespLevel();
            if (!$respLevel) {
                $respLevel = new RespLevel();
                $user->setRespLevel($respLevel);
            }
        } else {
            $user = new User();
            $respLevel = new RespLevel();
        }

        // Créer le formulaire avec une query builder personnalisée pour les niveaux
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->add('respLevel', RespLevelType::class, [
            'level_choices' => $levelRepository->createQueryBuilder('l')
                ->where('l.field = :field')
                ->setParameter('field', $respFieldField)
                ->getQuery()
                ->getResult()
        ]);

        if ($isEdit) {
            $form->remove('plainPassword');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$isEdit) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setRoles(['ROLE_RESPLEVEL']);
                $respLevel->setCreatedAt(new \DateTime());

                $respLevel->setCreatedBy($currentUser);
            }
            $this->handleProfilePictureUpload($form, $user, $slugger);

            $email = $form->get('email')->getData();
            $user->setEmail($email);

            $respLevel->setName($form->get('respLevel')->get('name')->getData());
            $respLevel->setCni($form->get('respLevel')->get('cni')->getData());
            $respLevel->setPhoneNumber($form->get('respLevel')->get('phone_number')->getData());
            $respLevel->setEmail($email);

            $level = $form->get('respLevel')->get('level')->getData();
            $respLevel->setLevel($level);

            $user->setRespLevel($respLevel);

            $entityManager->persist($user);
            $entityManager->persist($respLevel);
            $entityManager->flush();

            if ($isEdit) {
                $this->addFlash('success', 'Level Responsible information has been successfully updated.');
            } else {
                $this->addFlash('success', 'Level Responsible has been successfully registered.');
            }
            
            return $this->redirectToRoute('app_register_resplevel');
        }

        return $this->render('resp_level/register_resplevel.html.twig', [
            'registrationForm' => $form->createView(),
            'isEdit' => $isEdit,
        ]);
    }


    #[Route('/register/respue/{id<\d+>?0}', name: 'register_respue')]
    public function manageRespUe(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UERepository $ueRepository,
        Security $security,
        SluggerInterface $slugger,
        $id
    ): Response {
        $currentUser = $security->getUser();
        if (!$currentUser instanceof User) {
            return $this->redirectToRoute('app_login');
        }
    
        $respLevel = $currentUser->getRespLevel();
        if (!$respLevel) {
            throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour créer un responsable d\'UE.');
        }
    
        $isEdit = false;
        if ($id) {
            $isEdit = true;
        }
    
        if ($isEdit) {
            $user = $entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                throw $this->createNotFoundException('Utilisateur non trouvé');
            }
            $respUe = $user->getRespUe();
            if (!$respUe) {
                $respUe = new RespUe();
                $user->setRespUe($respUe);
            }
        } else {
            $user = new User();
            $respUe = new RespUe();
        }
    
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->add('respUe', RespUeType::class, [
            'ue_choices' => $ueRepository->findBy(['level' => $respLevel->getLevel()]),
        ]);
    
        if ($isEdit) {
            $form->remove('plainPassword');
        }
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$isEdit) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setRoles(['ROLE_RESPUE']);
                $respUe->setCreatedAt(new \DateTime());
                $respUe->setCreatedBy($currentUser);
            }
            $this->handleProfilePictureUpload($form, $user, $slugger);
    
            $email = $form->get('email')->getData();
            $user->setEmail($email);
    
            $respUe->setName($form->get('respUe')->get('name')->getData());
            $respUe->setCni($form->get('respUe')->get('cni')->getData());
            $respUe->setPhoneNumber($form->get('respUe')->get('phone_number')->getData());
            $respUe->setEmail($email);
    
            $ue = $form->get('respUe')->get('ue')->getData();
            $respUe->setUe($ue);
    
            $user->setRespUe($respUe);
    
            $entityManager->persist($user);
            $entityManager->persist($respUe);
            $entityManager->flush();
    
            $this->addFlash('success', $isEdit 
                ? 'Les informations du responsable d\'UE ont été mises à jour avec succès.' 
                : 'Le responsable d\'UE a été enregistré avec succès.');
            
            return $this->redirectToRoute('register_respue');
        }
    
        return $this->render('resp_ue/register_respue.html.twig', [
            'registrationForm' => $form->createView(),
            'isEdit' => $isEdit,
        ]);
    }

    
    #[Route('/register/respec/{id<\d+>?0}', name: 'register_respec')]
    public function manageRespEC(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        ECRepository $ecRepository,
        Security $security,
        SluggerInterface $slugger,
        $id
    ): Response {
        $currentUser = $security->getUser();
        if (!$currentUser instanceof User) {
            return $this->redirectToRoute('app_login');
        }
    
        $respUe = $currentUser->getRespUe();
        if (!$respUe) {
            throw $this->createAccessDeniedException('Vous n\'avez pas les droits pour créer un enseignant.');
        }
    
        $isEdit = false;
        if ($id) {
            $isEdit = true;
        }
    
        if ($isEdit) {
            $user = $entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                throw $this->createNotFoundException('Utilisateur non trouvé');
            }
            $teacher = $user->getTeacher();
            if (!$teacher) {
                $teacher = new Teacher();
                $user->setTeacher($teacher);
            }
        } else {
            $user = new User();
            $teacher = new Teacher();
            $user->setTeacher($teacher);
        }
    
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->add('teacher', TeacherType::class, [
            'data' => $teacher,
            'ec_choices' => $ecRepository->findBy(['ue' => $respUe->getUe()]),
        ]);
    
        if ($isEdit) {
            $form->remove('plainPassword');
        }
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$isEdit) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setRoles(['ROLE_TEACHER']);
                $teacher->setCreatedAt(new \DateTime());
                $teacher->setCreatedBy($currentUser);
            }
            $this->handleProfilePictureUpload($form, $user, $slugger);
    
            $email = $form->get('email')->getData();
            $user->setEmail($email);
    
            $teacherData = $form->get('teacher')->getData();
            $teacher->setName($teacherData->getName());
            $teacher->setCni($teacherData->getCni());
            $teacher->setPhoneNumber($teacherData->getPhoneNumber());
            $teacher->setEmail($email);
    
            foreach ($teacherData->getEcs() as $ec) {
                $teacher->addEc($ec);
            }
    
            $entityManager->persist($user);
            $entityManager->persist($teacher);
            $entityManager->flush();
    
            $this->addFlash('success', $isEdit 
                ? 'Les informations de l\'enseignant ont été mises à jour avec succès.' 
                : 'L\'enseignant a été enregistré avec succès.');
            
            return $this->redirectToRoute('register_respec');
        }
    
        return $this->render('teacher/register_respec.html.twig', [
            'registrationForm' => $form->createView(),
            'isEdit' => $isEdit,
        ]);
    }


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
                // Handle exception if something happens during file upload
            }
        }
    }

}
