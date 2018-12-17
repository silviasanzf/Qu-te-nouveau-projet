<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\Article1Type;
use App\Repository\ArticleRepository;
use App\Service\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods="GET")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', ['articles' => $articleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="article_new", methods="GET|POST")
     */
    public function new(Request $request, Slugify $slugify,  \Swift_Mailer $mailer): Response
    {
        $article = new Article();
        $form = $this->createForm(Article1Type::class, $article);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $slug = $slugify->generate($article->getTitle());
            $article->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $message = (new \Swift_Message())
                ->setFrom('silviasanz3@yahoo.fr')
                ->setTo('test1quete@gmail.com')
                ->setContentType("text/html")
                ->setBody($this->renderView('/article/email/notification.html.twig'))

    ;
    $mailer->send($message);

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="article_show", methods="GET")
     */
    public function show(Article $article): Response
    {

        return $this->render('article/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods="GET|POST")
     */
    public function edit(Request $request, Article $article, Slugify $slugify): Response
    {
        $form = $this->createForm(Article1Type::class, $article);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $article->setSlug($slugify->generate($article->getTitle()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index', ['id' => $article->getId()]);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods="DELETE")
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}
