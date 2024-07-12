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
    #[Route('/super_admin', name: 'app_super_admin_dash')]
    public function index1(): Response
    {
        $user = $this->getUser();
        return $this->render('super_admin_dashboard/index.html.twig', [
            'controller_name' => 'HomePageController', 'user'=>$user
        ]);
    }

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
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        // Collecter tous les privilèges uniques de l'utilisateur
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
            }
        }
    
        $schoolName = $session->get('school_name');
        $school = null;
    
        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        }
    
        return $this->render('responsable_dashboard/dashboardAdmin.html.twig', [
            "user" => $user,
            'school' => $school,
            'privileges' => array_values($privileges), // Convertir en tableau indexé
        ]);
    }    
    
#[Route('/student/dashboard', name: 'app_dashStudent')]
public function StudentDashboard(SessionInterface $session, EntityManagerInterface $entityManager): Response
{
    try {
        $user = $this->getUser();
        if (!$user) {
            throw new \Exception('Vous devez être connecté pour accéder à cette page.');
        }

        $student = $user->getStudent();
        if (!$student) {
            throw new \Exception('Aucun étudiant associé à cet utilisateur.');
        }

        // Collecter tous les privilèges uniques de l'utilisateur
        $privileges = [];
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                $privileges[$privilege->getId()] = $privilege; // Utiliser l'ID comme clé pour éviter les doublons
            }
        }

        $schoolName = $session->get('school_name');
        $school = null;
    
        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        }

        return $this->render('student_dashboard/index.html.twig', [
            'user' => $user,
            'student' => $student,
            'school' => $school,
            'privileges' => array_values($privileges), // Convertir en tableau indexé
        ]);

    } catch (\Exception $e) {
        $this->addFlash('error', $e->getMessage());
        return $this->redirectToRoute('app_login');
    }
}

public function someAction(): Response
{
    $user = $this->getUser();
    if (!$user) {
        return $this->redirectToRoute('app_login');
    }
    
    // Collect all unique privileges of the user
    $privileges = [];
    foreach ($user->getRole() as $role) {
        foreach ($role->getPrivileges() as $privilege) {
            $privileges[$privilege->getId()] = $privilege; // Use ID as key to avoid duplicates
        }
    }
    
    return $this->render('base_new.html.twig', [
        "user" => $user,
        'privileges' => array_values($privileges), // This line is important
    ]);
}

}

