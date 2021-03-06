<?php


namespace App\Controller\Content;


use App\Entity\ChapterIntro;
use App\Entity\IncarnateFeat;
use App\Repository\ChapterIntroRepository;
use App\Repository\IncarnateFeatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FeatController extends AbstractController
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
     * @Route("/content/feat/", name="inc_feats")
     */
    public function feats(IncarnateFeatRepository $incarnateFeatRepository, ChapterIntroRepository $chapterIntroRepository){
//        $featRepository = $this->em->getRepository(IncarnateFeat::class);
//        $feats = $featRepository->findAll();
//        $chapterRepository = $this->em->getRepository(ChapterIntro::class);
//        $intro = $chapterRepository->buildParagraphsByCategory('Feat Intro');
        $feats = $incarnateFeatRepository->findAll();
        $intro = $chapterIntroRepository->buildParagraphsByCategory('Feat Intro');
        return $this->render('content/feats.html.twig',[
            'genericParts' => $this->genericParts,
            'loop'=>$feats,
            'path'=>'inc_feat',
            'intro'=>$intro,
        ]);
    }
    /**
     * @Route("/content/feat/{slug}", name="inc_feat")
     */
    public function feat($slug){
        $featRepository = $this->em->getRepository(IncarnateFeat::class);
//        $feat=$featRepository->findOneBy(['fid'=>$slug]);
        $feat = findInRepository($slug,$featRepository);
        if (!$feat){
            throw $this->createNotFoundException('The feat: "' . $slug . '" does not exist');
        }
        return $this->render('content/feat.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
            'feat'=>$feat,
        ]);
    }
}