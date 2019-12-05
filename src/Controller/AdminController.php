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
     * @Route("/admin/import/start/")
     */
    public function importStart(){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/tables/';
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/tables/")
     */
    public function importTables(){
        $this->UGFImporter->importTables();
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/backgrounds/';
        return $this->redirect($path);
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
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/rules/';
        $this->UGFImporter->importBackgroundFeatures();
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/rules/")
     */
    public function importRules(){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/classes/';
        $this->UGFImporter->importChapterIntros();
        return new Response('Import Complete');
    }
    /**
     * @Route("/admin/import/classes/")
     */
    public function importClasses(){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import//';
        $this->UGFImporter->importClasses();
        return new Response('Import Complete');
    }
}