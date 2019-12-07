<?php


namespace App\Controller\Content;


use App\Entity\ChapterIntro;
use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;
use App\Entity\IncarnateTable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackgroundController extends AbstractController
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
     * @Route("/content/background/", name="inc_backgrounds")
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
     * @Route("/content/background/{slug}", name="inc_background")
     */
    public function background($slug){
        $backgroundRepository = $this->em->getRepository(IncarnateBackground::class);
        $background = $backgroundRepository->findOneBy(['fid'=>$slug]);
//        dump($background,$background->getIncarnateBackgroundFeatures());die;
//        $background = findInRepository($slug,$backgroundRepository);
//        if (!$background){
//            throw $this->createNotFoundException('The background: "' . $slug . '" does not exist');
//        }
//        $backgroundFeature = null;
//        if($background['featurefid']){
//            $backgroundFeatureRepository = $this->em->getRepository(IncarnateBackgroundFeature::class);
//            $backgroundFeature = $backgroundFeatureRepository->findOneByFid($background['featurefid']);
//        }
//        $backgroundFeature = $background
        $tableRepository = $this->em->getRepository(IncarnateTable::class);
        $personality = null;
        if($background->getPersonalityfid()){
            $personality = $tableRepository->findOneByFid($background->getPersonalityfid());
        }
        $ideal = null;
        if($background->getIdealfid()){
            $ideal = $tableRepository->findOneByFid($background->getIdealfid());
        }
        $bond = null;
        if($background->getBondfid()){
            $bond = $tableRepository->findOneByFid($background->getBondfid());
        }
        $flaw = null;
        if($background->getFlawfid()){
            $flaw = $tableRepository->findOneByFid($background->getFlawfid());
        }
        $rulesRepository = $this->em->getRepository(ChapterIntro::class);
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
            'personality' =>$personality,
            'ideal' =>$ideal,
            'bond' =>$bond,
            'flaw'=>$flaw,
        ]);
    }
}