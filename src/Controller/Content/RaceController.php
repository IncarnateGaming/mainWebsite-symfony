<?php


namespace App\Controller\Content;


use App\Entity\ChapterIntro;
use App\Entity\IncarnateRace;
use App\Repository\IncarnateRaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RaceController extends AbstractController
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
     * @Route("/content/race/", name="inc_races")
     */
    public function races(){
        $raceRepository = $this->em->getRepository(IncarnateRace::class);
        $races = $raceRepository->findAll();
        $chapterIntroRepository = $this->em->getRepository(ChapterIntro::class);
        $intro = $chapterIntroRepository->buildParagraphsByCategory('Race Intro');
        return $this->render('content/races.html.twig',[
            'genericParts' => $this->genericParts,
            'loop' => $races,
            'intro' => $intro,
            'path'=>'inc_race',
        ]);
    }
    /**
     * @Route("/content/race/{slug}", name="inc_race")
     */
    public function race(string $slug, IncarnateRaceRepository $raceRepository){
//        $raceRepository = $this->em->getRepository(IncarnateRace::class);
        $race = $raceRepository->findOneBy(['fid'=>$slug]);
//        dump($race);die;
//        $race = findInRepository($slug,$raceRepository);
        if($race){
            return $this->render('content/race.html.twig',[
                'genericParts' => $this->genericParts,
                'slug' => $slug,
                'race'=>$race,
            ]);
        }
        if(!$race){
            throw $this->createNotFoundException('The race: "' . $slug . '" does not exist');
        }
    }
}