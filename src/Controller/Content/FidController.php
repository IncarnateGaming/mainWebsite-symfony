<?php


namespace App\Controller\Content;


use App\Entity\IncarnateItem;
use App\Service\ImportUGF\BaseUGFImporter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FidController extends AbstractController
{
    /**
     * @var array
     */
    private $genericParts;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/content/fid/{slug}", name="inc_fid")
     */
    public function fid($slug, BaseUGFImporter $baseUGFImporter){
//        $incImportType = require('../src/Service/ImportUGF/ImportTypes.php');
        $incImportType = $baseUGFImporter->incImportType;
        $repository = $this->em->getRepository(IncarnateItem::class);
        $item = $repository->findOneBy(['fid'=>$slug]);
        if(!$item){
            throw $this->createNotFoundException('The fid: "' . $slug . '" does not exist');
        }
        $type = $item->getType();
        if ($incImportType['background']==$type||['backgroundFeature']==$type){
            return $this->redirect($this->generateUrl('inc_background',['slug'=>$slug]));
        }elseif ($incImportType['class']==$type||$incImportType['classTrait']==$type||$incImportType['classArchetype']==$type||$incImportType['classArchetypeTrait']==$type){
            return $this->redirect($this->generateUrl('inc_class',['slug'=>$slug]));
        }elseif ($incImportType['equipment']==$type||$incImportType['weapon']==$type||$incImportType['armor']==$type){
            return $this->redirect($this->generateUrl('inc_equipment',['slug'=>$slug]));
        }elseif ($incImportType['feat']==$type) {
            return $this->redirect($this->generateUrl('inc_feat',['slug'=>$slug]));
        }elseif($incImportType['magicProperty']==$type){
            return $this->redirect($this->generateUrl('inc_magic_property',['slug'=>$slug]));
        }elseif($incImportType['npc']==$type){
            return $this->redirect($this->generateUrl('inc_npc',['slug'=>$slug]));
        }elseif($incImportType['race']==$type||$incImportType['raceTrait']==$type||$incImportType['raceSubrace']==$type||$incImportType['raceSubraceTrait']==$type){
            return $this->redirect($this->generateUrl('inc_race',['slug'=>$slug]));
        }elseif($incImportType['raceSubrace']==$type||$incImportType['raceTrait']==$type||$incImportType['raceSubrace']==$type||$incImportType['raceSubraceTrait']==$type){
            return $this->redirect($this->generateUrl('inc_race',['slug'=>$slug]));
        }elseif($incImportType['raceTrait']==$type||$incImportType['raceTrait']==$type||$incImportType['raceSubrace']==$type||$incImportType['raceSubraceTrait']==$type){
            return $this->redirect($this->generateUrl('inc_race',['slug'=>$slug]));
        }elseif($incImportType['raceSubraceTrait']==$type||$incImportType['raceTrait']==$type||$incImportType['raceSubrace']==$type||$incImportType['raceSubraceTrait']==$type){
            return $this->redirect($this->generateUrl('inc_race',['slug'=>$slug]));
        }elseif($incImportType['riddle']==$type){
            return $this->redirect($this->generateUrl('inc_riddle',['slug'=>$slug]));
        }elseif($incImportType['rule']==$type){
            return $this->redirect($this->generateUrl('inc_rule',['slug'=>$slug]));
        }elseif($incImportType['skill']==$type){
            return $this->redirect($this->generateUrl('inc_skill',['slug'=>$slug]));
        }elseif($incImportType['spell']==$type){
            return $this->redirect($this->generateUrl('inc_spell',['slug'=>$slug]));
        }elseif ($incImportType['table']==$type){
            return $this->redirect($this->generateUrl('inc_table',['slug'=>$slug]));
        }elseif($incImportType['template']==$type){
            return $this->redirect($this->generateUrl('inc_template',['slug'=>$slug]));
        }else{
            throw $this->createNotFoundException('The fid: "' . $slug . '" does not have a valid type.');
        }
    }
}