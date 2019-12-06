<?php


namespace App\Controller\Content;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MagicalPropertyController extends AbstractController
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
}