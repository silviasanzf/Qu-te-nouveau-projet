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

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page}", defaults={"page"= "Article Sans Titre" }, requirements={"page"="([a-z0-9 \-]+)"},   name="blog_show")
     */
    public function show($page)
    {

        $page=ucwords(str_replace ("-" , " " , $page ));

        return $this->render('blog/index.html.twig', ['page' => $page]);
    }
}