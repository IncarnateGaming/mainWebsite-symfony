<?php


namespace App\Controller\Content;


use App\Entity\ChapterIntro;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RuleController extends AbstractController
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
     * @Route("/content/rule/", name="inc_rules")
     */
    public function rules(){
        $chapterIntroRepository = $this->em->getRepository(ChapterIntro::class);
        $categories = $chapterIntroRepository->arrayOfNonIntroCategories();
        return $this->render('content/rules.html.twig',[
            'genericParts' => $this->genericParts,
            'categories'=>$categories,
        ]);
    }
    /**
     * @Route("/content/rule/{slug}", name="inc_rule")
     */
    public function rule($slug){
        return $this->render('content/rule.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
        ]);
    }
}