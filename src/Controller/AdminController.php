<?php


namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use App\Service\UGFImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/import/backgrounds/")
     * @param UGFImporter $UGFImporter
     */
    public function import(UGFImporter $UGFImporter){
        $UGFImporter->importBackgrounds();
        return new Response('temp text');
    }
}