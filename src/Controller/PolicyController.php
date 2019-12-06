<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PolicyController extends AbstractController
{

    /**
     * @Route("/policy/website/", name="inc_policy")
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
     * @Route("/policy/igl/", name="inc_policy_general_license")
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
     * @Route("/policy/isam/", name="inc_policy_stand_alone")
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
     * @Route("/policy/iec/", name="inc_policy_embedded_content")
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