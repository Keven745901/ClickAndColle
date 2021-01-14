<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(Request $request): Response
    {   
        $session = $request->getSession();
       
        $mesitemspanier = ($session->get('panier'));
        $mesitemspanier = unserialize($mesitemspanier);
    
        return $this->render('panier/index.html.twig', [
            'panier' => $mesitemspanier,
        ]);
    }
}
