<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MagasinRepository;
use App\Repository\UserRepository;
use App\Repository\CreneauRepository;
use App\Entity\Contenir;
use App\Entity\Commande;
use App\Entity\Creneau;

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
    public function commander(Request $request, MagasinRepository $magasinRepository, UserRepository $userRepository, CreneauRepository $creneauRepository, \Swift_Mailer $mailer): Response
    {   
        $session = $request->getSession();
       
        $mesitemspanier = ($session->get('panier'));
        $mesitemspanier = unserialize($mesitemspanier);

        $entityManager = $this->getDoctrine()->getManager();

        if($request->query->get('calendrier') !== "" && $request->query->get('heure') !== null && $request->query->get('minutes') !== null){

            $heure = $request->query->get('heure');
            $minutes = $request->query->get('minutes');
            $dateSQL = $request->query->get('calendrier') . " " . $heure . ":" . $minutes . ":00"; 
            $dateSQL = \DateTime::createFromFormat('Y-m-d H:i:s',$dateSQL);

            $creneaux = $creneauRepository->findBy(
                ['dateCreneau' => $dateSQL,
                 'idMagasin' => $session->get('magasin')
                ]
            );
            if(count($creneaux) < 1){
                


                $u = $userRepository->find($this->getUser()->getId());
                $m = $magasinRepository->find($session->get('magasin'));

                $creneau = new Creneau();
                $creneau->setDateCreneau($dateSQL);
                $creneau->setEtatCreneau(1);
                $creneau->setIdMagasin($m);
                $creneau->setIdUser($u);
                
                $entityManager->persist($creneau);
                $entityManager->flush();

                
                $commande = new Commande();
                $commande->setDateCommande((\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))));
                $commande->setEtatCommande(1);

                
                
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
                 // On crée le message
                $message = (new \Swift_Message('Confirmation de commande'))
                // On attribue l'expéditeur
                ->setFrom("clickandcollect@gmail.com")
                // On attribue le destinataire
                ->setTo($u->getEmail())
                // On crée le texte avec la vue
                ->setBody("Votre commande a été valider avec succès !")
                ;
                $mailer->send($message);

                $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi
            }
        }
        $session->clear();
        
    
        return $this->redirect('/');
    }
}




