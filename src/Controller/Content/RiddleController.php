<?php


namespace App\Controller\Content;


use App\Entity\IncarnateRiddle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RiddleController extends AbstractController
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
     * @Route("/content/riddle/", name="inc_riddles")
     */
    public function riddles(){
        $riddleRepository = $this->em->getRepository(IncarnateRiddle::class);
        require_once '../lib/php/functions.php';
//        $equipment = findInRepository($slug,$equipmentRepository);
        $riddles = $riddleRepository->findAll();
        return $this->render('content/riddles.html.twig',[
            'genericParts' => $this->genericParts,
            'loop'=>$riddles,
            'intro'=>false,
            'path'=>'inc_riddle',
        ]);
    }
    /**
     * @Route("/content/riddle/{slug}", name="inc_riddle")
     */
    public function riddle($slug){
        $riddleRepository = $this->em->getRepository(IncarnateRiddle::class);
        require_once '../lib/php/functions.php';
        if('rand'===$slug){
            $riddles = $riddleRepository->findAll();
            shuffle($riddles);
            $riddle = $riddles[0];
        }else{
            $riddle = findInRepository($slug,$riddleRepository);
        }
        return $this->render('content/riddle.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
            'riddle'=>$riddle,
        ]);
    }
}