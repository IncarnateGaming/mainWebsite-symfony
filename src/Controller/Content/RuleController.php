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
//        dump($slug);die;
//        if(false !== strpos($slug,'#')){
//            $slug = substr($slug,0,16);
//        }
        $chapterRepository = $this->em->getRepository(ChapterIntro::class);
        $description = $chapterRepository->buildParagraphsByCategory($slug);
        if ($description === '' && strlen($slug) == 16) {
            $description = $chapterRepository->buildParagraphsByCategoryFid($slug);
        }
        if ($description !== '') {
            $chapter = array();
            $chapter['description'] = $description;
            $chapter['name'] = str_replace('-', ' ', $slug);
        }
        if(!$chapter){
            $chapter = findInRepository($slug,$chapterRepository);
        }
        if(!$chapter){
            throw $this->createNotFoundException('The rule: "' . $slug . '" does not exist');
        }
        return $this->render('content/rule.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
            'chapter'=>$chapter,
        ]);
    }
}