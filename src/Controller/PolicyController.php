<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PolicyController extends AbstractController
{

    /**
     * @Route("/policy/website/")
     * @Route("/policy/")
     */
    public function policy_website_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('policy/website.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
    /**
     * @Route("/policy/igl/")
     * @Route("/incarnategenerallicense/")
     */
    public function policy_igl_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('policy/igl.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
    /**
     * @Route("/policy/isam/")
     */
    public function policy_isam_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('policy/isam.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
    /**
     * @Route("/policy/iec/")
     */
    public function policy_iec_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('policy/iec.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}