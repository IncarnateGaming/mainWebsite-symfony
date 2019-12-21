<?php


namespace App\Controller;


use App\Service\ImportUGF\UGFImportBackgrounds;
use App\Service\ImportUGF\UGFImportChapterIntro;
use App\Service\ImportUGF\UGFImportClasses;
use App\Service\ImportUGF\UGFImportEquipment;
use App\Service\ImportUGF\UGFImportMagicProperty;
use App\Service\ImportUGF\UGFImportNPCs;
use App\Service\ImportUGF\UGFImportRaces;
use App\Service\ImportUGF\UGFImportRiddle;
use App\Service\ImportUGF\UGFImportRollableTables;
use App\Service\ImportUGF\UGFImportSkill;
use App\Service\ImportUGF\UGFImportSpell;
use App\Service\ImportUGF\UGFImportStart;
use App\Service\ImportUGF\UGFImportTemplate;
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
    public function importStart(UGFImportStart $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/rules/';
        $UGFImporter->purge();
        return $this->redirect($path);
//        return new Response('Import not started');
    }
    /**
     * @Route("/admin/import/rules/")
     */
    public function importRules(UGFImportChapterIntro $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/tables/';
        $UGFImporter->import();
        return $this->redirect($path);
//        return new Response('Import stopped at rules');
    }
    /**
     * @Route("/admin/import/tables/")
     */
    public function importTables(UGFImportRollableTables $UGFImporter){
        $UGFImporter->import();
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/backgrounds/';
        return $this->redirect($path);
//        return new Response('Import stopped at tables');
    }
    /**
     * @Route("/admin/import/backgrounds/")
     */
    public function importBackgrounds(UGFImportBackgrounds $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/classes/';
        $UGFImporter->import();
        return $this->redirect($path);
//        return new Response('Import stopped at backgrounds');
    }
    /**
     * @Route("/admin/import/classes/")
     */
    public function importClasses(UGFImportClasses $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/equipment/';
        $UGFImporter->import();
        return $this->redirect($path);
//        return new Response('Import stopped at classes');
    }
    /**
     * @Route("/admin/import/equipment/")
     */
    public function importEquipment(UGFImportEquipment $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/race/';
        $UGFImporter->import();
//        return new Response('Import stopped at equipment');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/race/")
     */
    public function importRaces(UGFImportRaces $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/riddle/';
        $UGFImporter->import();
//        return new Response('Import stopped at races');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/riddle/")
     */
    public function importRiddles(UGFImportRiddle $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/skill/';
        $UGFImporter->import();
//        return new Response('Import stopped at riddles');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/skill/")
     */
    public function importSkill(UGFImportSkill $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/spell/';
        $UGFImporter->import();
        return new Response('Import stopped at skills');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/spell/")
     */
    public function importSpell(UGFImportSpell $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/template/';
        $UGFImporter->import();
        return new Response('Import stopped at spells');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/template/")
     */
    public function importTemplates(UGFImportTemplate $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/npc/';
        $UGFImporter->import();
        return new Response('Import stopped at templates');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/npc/")
     */
    public function importNPCs(UGFImportNPCs $UGFImporter){
        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/magicProp/';
        $UGFImporter->import();
        return new Response('Import stopped at NPCs');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/magicProp/")
     */
    public function importMagicProp(UGFImportMagicProperty $UGFImporter){
//        $path = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'admin/import/npc/';
        $UGFImporter->import();
        return new Response('Import stopped at magic properties');
//        return $this->redirect($path);
    }
}