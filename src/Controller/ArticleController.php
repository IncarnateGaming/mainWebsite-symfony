<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('My first page already');
    }

    /**
     * @Route("/content/{slug}")
     */
    public function show($slug)
    {
        return new Response(sprintf(
            'My first page already: %s',
            $slug
        ));
    }
}