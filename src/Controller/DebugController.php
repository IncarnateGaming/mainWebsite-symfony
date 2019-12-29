<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DebugController extends AbstractController
{
    /**
     * @Route("/debug/mobile/", name="inc_mobile")
     */
    public function mobileController(){
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('debug/mobile.html.twig',[
            'genericParts' => $genericParts,
            'userAgent' => $_SERVER['HTTP_USER_AGENT'],
        ]);
    }
    /**
     * @Route("/debug/orientation/", name="inc_orientation")
     */
    public function orientationController()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('debug/orientation.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}