<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
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

    /**
     * @Route("/content/{slug}")
     */
    public function show($slug)
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('article/show.html.twig',[
            'title' => ucwords(str_replace('-',' ', $slug)),
            'genericParts' => $genericParts,
        ]);
    }
}