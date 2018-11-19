<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/11/18
 * Time: 16:31
 */


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Category;






class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Category $category) :Response
    {
        return $this->render('category.html.twig', ['category'=>$category]);

    }
}