<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class JoinController extends AbstractController
{
    /**
     * @Route("/join/")
     */
    public function join_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('join.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}