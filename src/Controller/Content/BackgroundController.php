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
        $background=null;
        if (strlen($slug)==16){
            $background = $backgroundRepository->findOneBy(['fid'=>$slug]);
        }
        if (!$background){
            $background = $backgroundRepository->findOneBy(['name'=>$slug]);
        }
        if(!$background && is_numeric($slug)){
            $background = $backgroundRepository->find(intval($slug));
        }
        if(!$background){
            throw $this->createNotFoundException('The background: "' . $slug . '" does not exist');
        }
        return $this->render('content/background.html.twig',[
            'genericParts' => $this->genericParts,
            'background' => $background,
            'slug' => $slug,
        ]);
    }
}