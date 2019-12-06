<?php


namespace App\Controller\Content;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClassController extends AbstractController
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
}