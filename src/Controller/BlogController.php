<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 12/11/18
 * Time: 11:59
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
//use App\Form\ArticleSearchType;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * form add Category
     *
     * @Route("/category", name="blog_addCategory")
     * @return Response A response instance
     */

    public function addCategory (Request $request): Response
    {
        $category = new Category ();
        $form = $this->createForm(
            CategoryType::class, $category);

        $form->handleRequest($request);

        $em = $this->getDoctrine()
            ->getManager();

        if($form->isSubmitted()){
        $em->persist($category);
        $em->flush();}



        return $this->render(
            'blog/addCategory.html.twig', [

                'form' => $form->createView(),
            ]
        );
    }




    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */
    public function index (): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }


        return $this->render(
            'blog/index.html.twig', [
                'articles' => $articles,
                'form' => $form->createView(),
            ]
         );
    }


    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     * @return Response A response instance
     */
    public function show ($slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        $articleCategory=$article->getCategory();

        $nameTag=$article->getTags();





        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
                'category'=> $articleCategory,
                'tag'=>$nameTag,

            ]
        );
    }

    /**
     * Getting all articles of a category
     *
     * @param string category
     *
     * @Route("/category/{category}", name="blog_show_category")
     *
     * @return Response A response instance
     */

    public function showByCategory (string $category): Response
    {
        if (!$category) {
            throw $this
                ->createNotFoundException('No category has been sent to find an article in article\'s table.');
        }


        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($category);



        $articles=$category->getArticles();


        if (!$category) {
            throw $this->createNotFoundException(
                'No category with ' . $category . ' name, found in category table.'
            );
        }


        /*$articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array('category' => $category),
                array('id' => 'desc'),
                3
                 );*/


        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles,

            ]
        );


    }

    /**
     * Getting all articles of a tag
     *
     * @param string tag
     *
     * @Route("/tag/{name}", name="blog_show_tag")
     *
     * @return Response A response instance
     */


    public function showByTagName(string $name): Response
    {


        $tag = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findOneByName($name);



        $articles=$tag->getArticles();





        /*$articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array('category' => $category),
                array('id' => 'desc'),
                3
                 );*/


        return $this->render(
            'blog/tag.html.twig',
            [
                'tag' => $tag,
                'articles' => $articles,

            ]
        );






    }








}