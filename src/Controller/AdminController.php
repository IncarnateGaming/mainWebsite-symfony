<?php


namespace App\Controller;


use App\Service\ImportUGF\UGFImportBackgrounds;
use App\Service\ImportUGF\UGFImportChapterIntro;
use App\Service\ImportUGF\UGFImportClasses;
use App\Service\ImportUGF\UGFImportRollableTables;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UGFImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
//    public function __construct(UGFImporter $UGFImporter)
//    {
//        $this->UGFImporter = $UGFImporter;
////        $this->request = $request;
//    }

    /**
     * @Route("/admin/import/start/", name="inc_import_start")
     */
    public function importStart(){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/tables/';
        return $this->redirect($path);
//        return new Response('Import not started');
    }
    /**
     * @Route("/admin/import/tables/")
     */
    public function importTables(UGFImportRollableTables $UGFImporter){
        $UGFImporter->importTables();
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/backgrounds/';
        return $this->redirect($path);
//        return new Response('Import stopped at tables');
    }
    /**
     * @Route("/admin/import/backgrounds/")
     */
    public function importBackgrounds(UGFImportBackgrounds $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/rules/';
        $UGFImporter->importBackgrounds();
        return $this->redirect($path);
//        return new Response('Import stopped at backgrounds');
    }
    /**
     * @Route("/admin/import/rules/")
     */
    public function importRules(UGFImportChapterIntro $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/classes/';
        $UGFImporter->importChapterIntros();
        return $this->redirect($path);
//        return new Response('Import stopped at rules');
    }
    /**
     * @Route("/admin/import/classes/")
     */
    public function importClasses(UGFImportClasses $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import//';
        $UGFImporter->importClasses();
        return new Response('Import stopped at classes');
    }
}