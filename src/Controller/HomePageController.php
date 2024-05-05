<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
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

    #[Route('/login', name: 'app_login_page')]
    public function login(){
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/register', name: 'app_register_page')]
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

