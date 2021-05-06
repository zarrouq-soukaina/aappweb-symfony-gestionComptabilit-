<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ProjetController extends AbstractController
{
    /**
     * @Route("/projet")
     */
    
    public function index()
    {
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('projet/home.html.twig', ['title' =>"Bienvenue "]);
    }

   
    
}
