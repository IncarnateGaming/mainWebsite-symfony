<?php


namespace App\Controller;


use App\Service\UGFImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{

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

    /**
     * @Route("/admin/import/backgrounds/")
     * @param UGFImporter $UGFImporter
     */
    public function import(UGFImporter $UGFImporter){
        $UGFImporter->importBackgrounds();
        return new Response('temp text');
    }
}