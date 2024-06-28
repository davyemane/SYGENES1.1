<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
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

    #[Route('/admin', name: 'app_dashAdmin'),
    IsGranted('ROLE_ADMIN')
    ]
    public function dashboard(){
        $user = $this->getUser();
        return $this->render('responsable_dashboard/dashboardAdmin.html.twig',[
            "user" => $user
        ]) ;  
    }

    #[Route('/student/dashboard', name: 'app_dashStudent'),
    IsGranted('ROLE_USER')
    ]
    public function StudentDashboard(){
            $user = $this->getUser();
            return $this->render('home_page/index.html.twig',[
                "user" => $user
            ]) ;  
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

