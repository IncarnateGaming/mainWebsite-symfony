<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{

    /**
     * @Route("/dummy/reference/people/wont/find/{slug}")
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