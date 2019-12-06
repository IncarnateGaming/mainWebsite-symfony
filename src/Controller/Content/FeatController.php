<?php


namespace App\Controller\Content;


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
}