<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UGFImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function __construct(UGFImporter $UGFImporter)
    {
        $this->UGFImporter = $UGFImporter;
//        $this->request = $request;
    }

    /**
     * @Route("/admin/import/backgrounds/")
     */
    public function importBackgrounds(){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/backgroundFeatures/';
        $this->UGFImporter->importBackgrounds();
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/backgroundFeatures/")
     */
    public function importBackgroundFeatures(){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/tables/';
        $this->UGFImporter->importBackgroundFeatures();
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/tables/")
     */
    public function importTables(){
        $this->UGFImporter->importTables();
        return new Response('temp text');
    }
}