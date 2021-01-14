<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\MagasinType;
use App\Repository\MagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/magasin")
 */
class MagasinController extends AbstractController
{
    /**
     * @Route("/", name="magasin_index", methods={"GET"})
     */
    public function index(Request $request, MagasinRepository $magasinRepository): Response
    {
        $recherche = $request->query->get('recherche');

        if(isset($recherche) && $recherche != ""){
            return $this->render('magasin/index.html.twig', [
                'magasins' => $magasinRepository->findBy([
                    'codePostal'=>$recherche
                ]),
            ]);
        }
        else{
            return $this->render('magasin/index.html.twig', [
                'magasins' => $magasinRepository->findAll(),
                ]);
        }
    }

    /**
     * @Route("/new", name="magasin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $magasin = new Magasin();
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($magasin);
            $entityManager->flush();

            return $this->redirectToRoute('magasin_index');
        }

        return $this->render('magasin/new.html.twig', [
            'magasin' => $magasin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magasin_show", methods={"GET"})
     */
    
    public function show(Request $request, Magasin $magasin, ArticleRepository $produit): Response
    {
        $session = $request->getSession();

        if($request->query->get('produit') !== null)
        {
            if($session->get('magasin') === null){
                $session->set('magasin', $magasin->getId());
            }

            $p = $request->query->get('produit');
            

            $temp = [];
            if($session->get('magasin') == $magasin->getId()){
                $temp = unserialize($session->get('panier'));
            }
            else{
                $session->set('magasin', null);
            }
            
            $temp[] = $produit->find($p);
            $produit->find($p)->getIdTypeArticle()->getLibelle(); //??????????????????????????????
            $session->set('panier', serialize($temp));
        
        }

        $stock = $magasin->getStocks();
        return $this->render('magasin/show.html.twig', [
            'magasin' => $magasin,
            'stock' => $stock
        ]);
    }

    /**
     * @Route("/{id}/edit", name="magasin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Magasin $magasin): Response
    {
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magasin_index');
        }

        return $this->render('magasin/edit.html.twig', [
            'magasin' => $magasin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magasin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Magasin $magasin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magasin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($magasin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('magasin_index');
    }
    
}
