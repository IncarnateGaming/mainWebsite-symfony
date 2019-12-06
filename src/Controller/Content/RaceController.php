<?php


namespace App\Controller\Content;


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
}