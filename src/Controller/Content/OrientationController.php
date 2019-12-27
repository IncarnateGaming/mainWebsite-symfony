<?php


namespace App\Controller\Content;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrientationController extends AbstractController
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
     * @Route("/content/orientation/", name="inc_orientation")
     */
    public function feats(){
        return $this->render('content/orientation.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
}