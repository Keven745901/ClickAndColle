<?php

namespace App\Controller;

use App\Entity\TypeArticle;
use App\Form\TypeArticleType;
use App\Repository\TypeArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/article")
 */
class TypeArticleController extends AbstractController
{
    /**
     * @Route("/", name="type_article_index", methods={"GET"})
     */
    public function index(TypeArticleRepository $typeArticleRepository): Response
    {
        return $this->render('type_article/index.html.twig', [
            'type_articles' => $typeArticleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeArticle = new TypeArticle();
        $form = $this->createForm(TypeArticleType::class, $typeArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeArticle);
            $entityManager->flush();

            return $this->redirectToRoute('type_article_index');
        }

        return $this->render('type_article/new.html.twig', [
            'type_article' => $typeArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_article_show", methods={"GET"})
     */
    public function show(TypeArticle $typeArticle): Response
    {
        return $this->render('type_article/show.html.twig', [
            'type_article' => $typeArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeArticle $typeArticle): Response
    {
        $form = $this->createForm(TypeArticleType::class, $typeArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_article_index');
        }

        return $this->render('type_article/edit.html.twig', [
            'type_article' => $typeArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeArticle $typeArticle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeArticle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeArticle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_article_index');
    }
}
