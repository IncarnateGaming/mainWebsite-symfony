<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('home.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}