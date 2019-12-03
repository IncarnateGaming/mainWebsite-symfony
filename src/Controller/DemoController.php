<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo/")
     */
    public function demo_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('demo.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}