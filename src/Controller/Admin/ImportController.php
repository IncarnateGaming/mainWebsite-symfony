<?php


namespace App\Controller\Admin;


use App\Service\ImportUGF\UGFImportBackgrounds;
use App\Service\ImportUGF\UGFImportChapterIntro;
use App\Service\ImportUGF\UGFImportClasses;
use App\Service\ImportUGF\UGFImportEquipment;
use App\Service\ImportUGF\UGFImportFeat;
use App\Service\ImportUGF\UGFImportLore;
use App\Service\ImportUGF\UGFImportMagicProperty;
use App\Service\ImportUGF\UGFImportNPCs;
use App\Service\ImportUGF\UGFImportRaces;
use App\Service\ImportUGF\UGFImportRiddle;
use App\Service\ImportUGF\UGFImportRollableTables;
use App\Service\ImportUGF\UGFImportSkill;
use App\Service\ImportUGF\UGFImportSpell;
use App\Service\ImportUGF\UGFImportStart;
use App\Service\ImportUGF\UGFImportTemplate;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UGFImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class ImportController extends AbstractController
{
    public function __construct()
    {
        if($_SERVER['HTTP_HOST']){
            $serverRoute = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        }elseif($_SERVER['SYMFONY_DEFAULT_ROUTE_URL']){
            $serverRoute = $_SERVER['SYMFONY_DEFAULT_ROUTE_URL'];
        }
        $this->serverRoute = $serverRoute;
    }

//    Mass Delete

    /**
     * @Route("/admin/import/start/", name="inc_import_start")
     */
    public function importStart(UGFImportStart $UGFImporter){
        $path = $this->serverRoute . 'admin/import/rules/';
        $UGFImporter->purge();
        return $this->redirect($path);
//        return new Response('Import not started');
    }

//    Foundational Elements

    /**
     * @Route("/admin/import/rules/")
     */
    public function importRules(UGFImportChapterIntro $UGFImporter){
        $path = $this->serverRoute . 'admin/import/tables/';
        $UGFImporter->import();
        return $this->redirect($path);
//        return new Response('Import stopped at rules');
    }
    /**
     * @Route("/admin/import/tables/")
     */
    public function importTables(UGFImportRollableTables $UGFImporter){
        $UGFImporter->import();
        $path = $this->serverRoute . 'admin/import/backgrounds/';
        return $this->redirect($path);
//        return new Response('Import stopped at tables');
    }

//    Content Based Elements

    /**
     * @Route("/admin/import/backgrounds/")
     */
    public function importBackgrounds(UGFImportBackgrounds $UGFImporter){
        $path = $this->serverRoute . 'admin/import/classes/';
        $UGFImporter->import();
        return $this->redirect($path);
//        return new Response('Import stopped at backgrounds');
    }
    /**
     * @Route("/admin/import/classes/")
     */
    public function importClasses(UGFImportClasses $UGFImporter){
        $path = $this->serverRoute . 'admin/import/equipment/';
        $UGFImporter->import();
        return $this->redirect($path);
//        return new Response('Import stopped at classes');
    }
    /**
     * @Route("/admin/import/equipment/")
     */
    public function importEquipment(UGFImportEquipment $UGFImporter){
        $path = $this->serverRoute . 'admin/import/race/';
        $UGFImporter->import();
//        return new Response('Import stopped at equipment');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/race/")
     */
    public function importRaces(UGFImportRaces $UGFImporter){
        $path = $this->serverRoute . 'admin/import/riddle/';
        $UGFImporter->import();
//        return new Response('Import stopped at races');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/riddle/")
     */
    public function importRiddles(UGFImportRiddle $UGFImporter){
        $path = $this->serverRoute . 'admin/import/skill/';
        $UGFImporter->import();
//        return new Response('Import stopped at riddles');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/skill/")
     */
    public function importSkill(UGFImportSkill $UGFImporter){
        $path = $this->serverRoute . 'admin/import/feat/';
        $UGFImporter->import();
//        return new Response('Import stopped at skills');
        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/feat/")
     */
    public function importFeat(UGFImportFeat $UGFImporter){
        $path = $this->serverRoute . 'admin/import/spell/';
        $UGFImporter->import();
        return new Response('Import stopped at feats');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/spell/")
     */
    public function importSpell(UGFImportSpell $UGFImporter){
        $path = $this->serverRoute . 'admin/import/template/';
        $UGFImporter->import();
        return new Response('Import stopped at spells');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/template/")
     */
    public function importTemplates(UGFImportTemplate $UGFImporter){
        $path = $this->serverRoute . 'admin/import/npc/';
        $UGFImporter->import();
        return new Response('Import stopped at templates');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/npc/")
     */
    public function importNPCs(UGFImportNPCs $UGFImporter){
        $path = $this->serverRoute . 'admin/import/magicProp/';
        $UGFImporter->import();
        return new Response('Import stopped at NPCs');
//        return $this->redirect($path);
    }
    /**
     * @Route("/admin/import/magicProp/")
     */
    public function importMagicProp(UGFImportMagicProperty $UGFImporter){
//        $path = $this->>serverRoute . 'admin/import/lore/';
        $UGFImporter->import();
        return new Response('Import stopped at magic properties');
//        return $this->redirect($path);
    }

//    Final Elements

    /**
     * @Route("/admin/import/lore/")
     */
    public function importLore(UGFImportLore $UGFImporter){
//        $path = $this->>serverRoute . 'admin/import/npc/';
        $UGFImporter->import();
        return new Response('Import completed.');
//        return $this->redirect($path);
    }
}