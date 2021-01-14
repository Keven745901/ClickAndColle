<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MagasinRepository;
use App\Repository\UserRepository;
use App\Entity\Contenir;
use App\Entity\Commande;

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

    /**
     * @Route("/commander", name="commander")
     */
    public function commander(Request $request, MagasinRepository $magasinRepository, UserRepository $userRepository): Response
    {   
        $session = $request->getSession();
       
        $mesitemspanier = ($session->get('panier'));
        $mesitemspanier = unserialize($mesitemspanier);

        $entityManager = $this->getDoctrine()->getManager();

        $commande = new Commande();
        $commande->setDateCommande((\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))));
        $commande->setEtatCommande(1);

        $m = $magasinRepository->find($session->get('magasin'));
        $u = $userRepository->find($this->getUser()->getId());
        $commande->setIdMagasin($m);
        $commande->setIdUser($u);

        $entityManager->persist($commande);
        $entityManager->flush();

        $stocks = $m->getStocks();
        $i=0;
        foreach($mesitemspanier as $item){

            $ligne = new Contenir();
            $ligne->setQuantiteCommandee($request->query->get('txt'.$i));
            $ligne->setIdArticle($item);
            $ligne->setIdCommande($commande);

            $entityManager->persist($ligne);
            $entityManager->flush();
            $i++;
        }
    
        return $this->redirect('/');
    }
}
