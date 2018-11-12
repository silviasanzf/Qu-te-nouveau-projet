<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 12/11/18
 * Time: 10:30
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */




    public function index()
    {

        return $this->render('/home.html.twig');


        #return new Response('Hello WCS');
    }

}