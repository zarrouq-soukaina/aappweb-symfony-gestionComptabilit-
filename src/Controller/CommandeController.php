<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/commande")
 */

class CommandeController extends AbstractController
{
 
    /**
     * @Route("/", name="commande_index")
     */
    public function commande(){

        return $this->render('commande/commande.html.twig');
    }
    
    
}

    