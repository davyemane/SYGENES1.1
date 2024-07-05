<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
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
    public function dashboard(): Response
    {
        // Check if the user has ROLE_ADMIN
        $user = $this->getUser();

        $colorScheme = [
            'primaryColor' => '#ffed4a', // Replace with your primary color
            'secondaryColor' => '#ffed4a', // Replace with your secondary color
            'accentColor' => '#ffed4a', // Replace with your accent color
            'backgroundColor' => '#ffed4a', // Replace with your background color
            'textColor' => '#ffed4a' // Replace with your text color
        ];

        // Assuming the user has only one role
        $roles = $user->getRole(); // Assuming getRoles() returns a collection of roles
        $school = null;

        if (!empty($roles)) {
            // Get the first role (assuming it's a single role for the user)
            $role = $roles[0]; // Adjust this based on your actual logic
            $school = $role->getSchool();
        }
dump($school);
        return $this->render('responsable_dashboard/dashboardAdmin.html.twig', [
            "user" => $user,
            'color_scheme' => $colorScheme,
            'school' => $school
        ]);
    }
    #[Route('/student/dashboard', name: 'app_dashStudent')]
    public function StudentDashboard(ManagerRegistry $doctrine): Response
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

            $colorScheme = [
                'primaryColor' => '#ffed4a', // Replace with your primary color
                'secondaryColor' => '#ffed4a', // Replace with your secondary color
                'accentColor' => '#ffed4a', // Replace with your accent color
                'backgroundColor' => '#ffed4a', // Replace with your background color
                'textColor' => '#ffed4a' // Replace with your text color
            ];
            $school = $student->getField()->getSchool();
            return $this->render('student_dashboard/index.html.twig', [
                'user' => $user,
                'student' => $student,
                'color_scheme'=>$colorScheme,
                'school'=>$school,
            ]);

        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/register1', name: 'app_register_page')]
    public function register(){
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/register_temp', name: 'app_register_temp_page')]
    public function register_temp(){
        return $this->render('home_page/registration_temp.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

}

