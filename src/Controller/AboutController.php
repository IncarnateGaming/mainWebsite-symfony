<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AboutController extends AbstractController
{
    /**
     * @Route("/about/")
     */
    public function about_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('about.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}