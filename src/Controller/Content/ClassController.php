<?php


namespace App\Controller\Content;


use App\Entity\ChapterIntro;
use App\Entity\IncarnateClass;
use App\Entity\IncarnateClassArchetype;
use App\Entity\IncarnateClassArchetypeTrait;
use App\Entity\IncarnateClassTrait;
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
     * @Route("/content/class/", name="inc_classes")
     */
    public function classes(){
        $classRepository = $this->em->getRepository(IncarnateClass::class);
        $classes = $classRepository->findAll();
        $chapterIntroRepository = $this->em->getRepository(ChapterIntro::class);
        $intro = $chapterIntroRepository->buildParagraphsByCategory('Class Intro');
        return $this->render('content/classes.html.twig',[
            'genericParts' => $this->genericParts,
            'classes'=>$classes,
            'intro'=>$intro,
        ]);
    }
    /**
     * @Route("/content/class/{slug}", name="inc_class")
     */
    public function class($slug){
        $classRepository = $this->em->getRepository(IncarnateClass::class);
        require_once '../lib/php/functions.php';
//        $class = $classRepository->findOneBy(['fid'=>$slug]);
        $class = findInRepository($slug,$classRepository);
        if($class){
            return $this->render('content/class.html.twig',[
                'genericParts' => $this->genericParts,
                'slug' => $slug,
                'class'=>$class,
            ]);
        }
        $classArchetypeRepository = $this->em->getRepository(IncarnateClassArchetype::class);
//        $archetype = findInRepository($slug,$classArchetypeRepository);
        $archetype = $classArchetypeRepository->findOneBy(['fid'=>$slug]);
        if($archetype){
            return $this->render('content/classarchetype.html.twig',[
                'genericParts' => $this->genericParts,
                'slug' => $slug,
                'archetype'=>$archetype,
            ]);
        }
        $classTraitRepository = $this->em->getRepository(IncarnateClassTrait::class);
        $trait = $classTraitRepository->findOneBy(['fid'=>$slug]);
        if($trait) {
            $parentfid = $trait->getIncarnateClass()->getFid();
        }else{
            $classArchetypeTraitRepository = $this->em->getRepository(IncarnateClassArchetypeTrait::class);
            $trait = $classArchetypeTraitRepository->findOneBy(['fid'=>$slug]);
            if ($trait){
                $parentfid = $trait->getIncarnateClassArchetype()->getFid();
            }
        }
        if($trait) {
            return $this->render('content/classtrait.html.twig',[
                'genericParts' => $this->genericParts,
                'slug' => $slug,
                'trait'=>$trait,
                'parentfid'=>$parentfid,
            ]);
        }else{
            throw $this->createNotFoundException('The class: "' . $slug . '" does not exist');
        }
    }
}