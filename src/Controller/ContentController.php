<?php


namespace App\Controller;


use App\Entity\ChapterIntro;
use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;
use App\Entity\IncarnateTable;
use App\Repository\ChapterIntroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    /**
     * @var array
     */
    private $genericParts;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        require '../lib/php/functions.php';
        $this->genericParts = genericParts();
    }

    /**
     * @Route("/content/background/")
     */
    public function backgrounds()
    {
        $backgroundRepository = $this->em->getRepository(IncarnateBackground::class);
        $backgrounds = $backgroundRepository->findAll();
        $chapterIntroRepository = $this->em->getRepository(ChapterIntro::class);
        $intro = $chapterIntroRepository->buildParagraphsByCategory('Background Intro');
        return $this->render('content/backgrounds.html.twig',[
            'genericParts' => $this->genericParts,
            'backgrounds' => $backgrounds,
            'intro' => $intro,
        ]);
    }
    /**
     * @Route("/content/background/{slug}")
     */
    public function background($slug){
        $backgroundRepository = $this->em->getRepository(IncarnateBackground::class);
        if(intval($slug) > 0 or "0" == $slug){
            $background = $backgroundRepository->findOneById(intval($slug));
        }elseif(16 == strlen($slug)){
            $background = $backgroundRepository->findOneByFid($slug);
            if (null == $background){
                $background = $backgroundRepository->findOneByName($slug);
            }
        }else{
            $background = $backgroundRepository->findOneByName($slug);
        }
        if (!$background){
            throw $this->createNotFoundException('The background: "' . $slug . '" does not exist');
        }
        $backgroundFeature = null;
        if($background['featurefid']){
            $backgroundFeatureRepository = $this->em->getRepository(IncarnateBackgroundFeature::class);
            $backgroundFeature = $backgroundFeatureRepository->findOneByFid($background['featurefid']);
        }
        $tableRepository = $this->em->getRepository(IncarnateTable::class);
        $personality = null;
        if($background['personalityfid']){
            $personality = $tableRepository->findOneByFid($background['personalityfid']);
        }
        $ideal = null;
        if($background['idealfid']){
            $ideal = $tableRepository->findOneByFid($background['idealfid']);
        }
        $bond = null;
        if($background['bondfid']){
            $bond = $tableRepository->findOneByFid($background['bondfid']);
        }
        $flaw = null;
        if($background['flawfid']){
            $flaw = $tableRepository->findOneByFid($background['flawfid']);
        }
        $rulesRepository = $this->em->getRepository(ChapterIntro::class);
        $intro = $rulesRepository->findOneByFid('');
//        $countedEntries = $backgroundRepository->count([]);
//        $navButtons = array(
//            'next'=>$_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'content/background/',
//            'prev'=>$_SERVER['SYMFONY_DEFAULT_ROUTE_URL'] . 'content/background/',
//        );
//        if($background['id'] + 1 >= $countedEntries){
//            $navButtons['next'] .= '0';
//        }else{
//            $navButtons['next'] .= ($background['id'] + 1);
//        }
//        if($background['id'] - 1 < 0){
//            $navButtons['']
//        }
        return $this->render('content/background.html.twig',[
            'genericParts' => $this->genericParts,
            'background' => $background,
            'slug' => $slug,
            'feature' =>$backgroundFeature,
            'personality' =>$personality,
            'ideal' =>$ideal,
            'bond' =>$bond,
            'flaw'=>$flaw,
        ]);
    }
    /**
     * @Route("/content/class/")
     */
    public function classes(){
        return $this->render('content/classes.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/class/{slug}")
     */
    public function class($slug){
        return $this->render('content/class.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/equipment/")
     */
    public function equipments(){
        return $this->render('content/equipments.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/equipment/{slug}")
     */
    public function equipment($slug){
        return $this->render('content/equipment.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/feat/")
     */
    public function feats(){
        return $this->render('content/feats.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/feat/{slug}")
     */
    public function feat($slug){
        return $this->render('content/feat.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/magicProperty/")
     */
    public function magicprops(){
        return $this->render('content/magicprops.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/magicProperty/{slug}")
     */
    public function magicprop($slug){
        return $this->render('content/magicprop.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/npc/")
     */
    public function npcs(){
        return $this->render('content/npcs.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/npc/{slug}")
     */
    public function npc($slug){
        return $this->render('content/npc.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/lore/")
     */
    public function lores(){
        return $this->render('content/lores.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/lore/{slug}")
     */
    public function lore($slug){
        return $this->render('content/lore.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/race/")
     */
    public function races(){
        return $this->render('content/races.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/race/{slug}")
     */
    public function race($slug){
        return $this->render('content/race.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/riddle/")
     */
    public function riddles(){
        return $this->render('content/riddles.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/riddle/{slug}")
     */
    public function riddle($slug){
        return $this->render('content/riddle.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/rule/")
     */
    public function rules(){
        return $this->render('content/rules.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/rule/{slug}")
     */
    public function rule($slug){
        return $this->render('content/rule.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/skill/")
     */
    public function skills(){
        return $this->render('content/skills.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/skill/{slug}")
     */
    public function skill($slug){
        return $this->render('content/skill.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/spell/")
     */
    public function spells(){
        return $this->render('content/spells.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/spell/{slug}")
     */
    public function spell($slug){
        return $this->render('content/spell.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/table/")
     */
    public function tables(){
        return $this->render('content/tables.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/table/{slug}")
     */
    public function table($slug){
        return $this->render('content/table.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
    /**
     * @Route("/content/template/")
     */
    public function templates(){
        return $this->render('content/templates.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/template/{slug}")
     */
    public function template($slug){
        return $this->render('content/template.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
}