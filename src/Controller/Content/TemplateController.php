<?php


namespace App\Controller\Content;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
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
     * @Route("/content/template/")
     */
    public function templates(){
        return $this->render('content/templates.html.twig',[
            'genericParts' => $this->genericParts,
        ]);
    }
    /**
     * @Route("/content/template/{slug}")
     */
    public function template($slug){
        return $this->render('content/template.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
}