<?php

namespace App\Controller;

use App\Entity\School;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomePageController extends AbstractController
{
    #[Route('/welcome', name: 'app_home_page')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController', 'user'=>$user
        ]);
    }


    #[Route('/about', name: 'app_about_page')]
    public function about(){
        return $this->render('home_page/about.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/contact_us', name: 'app_contact_us_page')]
    public function contactUs(){
        return $this->render('home_page/contact_us.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/documentation', name: 'app_documentation_page')]
    public function documentation(){
        return $this->render('home_page/documentation.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/test', name: 'app_login_page')]
    public function login(){
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/admin', name: 'app_dashAdmin')]
    public function dashboard(SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        $schoolName = $session->get('school_name');
        $school = null;
    
        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        }


        // Check if the user has ROLE_ADMIN
        $user = $this->getUser();

        $colorScheme = [
            'primaryColor' => '#3490dc', // Bleu vif pour la couleur principale
            'secondaryColor' => '#ffed4a', // Jaune doré pour la couleur secondaire
            'accentColor' => '#e3342f', // Rouge vif pour les accents
            'backgroundColor' => '#f8fafc', // Blanc cassé pour l'arrière-plan
            'textColor' => '#2d3748' // Gris foncé pour le texte
        ];

        // Assuming the user has only one role
        
        return $this->render('responsable_dashboard/dashboardAdmin.html.twig', [
            "user" => $user,
            'color_scheme' => $colorScheme,
            'school' => $school
        ]);
    }
    
    
    #[Route('/student/dashboard', name: 'app_dashStudent')]
    public function StudentDashboard(ManagerRegistry $doctrine, SessionInterface $session, EntityManagerInterface $entityManager): Response
    {


        $colorScheme = [
            'primaryColor' => '#ffed4a', // Replace with your primary color
            'secondaryColor' => '#ffed4a', // Replace with your secondary color
            'accentColor' => '#ffed4a', // Replace with your accent color
            'backgroundColor' => '#ffed4a', // Replace with your background color
            'textColor' => '#ffed4a' // Replace with your text color
        ];
        try {
            $user = $this->getUser();

            if (!$user) {
                throw new \Exception('Vous devez être connecté pour accéder à cette page.');
            }

            $student = $user->getStudent();

            if (!$student) {
                throw new \Exception('Aucun étudiant associé à cet utilisateur.');
            }

            //recupere le role
            $schoolName = $session->get('school_name');
            $school = null;
        
            if ($schoolName) {
                // Trouver l'entité School correspondante
                $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
            }
                    return $this->render('student_dashboard/index.html.twig', [
                'user' => $user,
                'student' => $student,
                'school'=>$school,
            ]);

        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_login');
        }
    }


}

