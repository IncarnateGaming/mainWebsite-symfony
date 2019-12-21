<?php


namespace App\Controller\Content;


use App\Entity\ChapterIntro;
use App\Repository\ChapterIntroRepository;
use App\Repository\IncarnateSkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
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
     * @Route("/content/skill/", name="inc_skills")
     */
    public function skills(IncarnateSkillRepository $skillRepository, ChapterIntroRepository $chapterRepository){
        $skills = $skillRepository->findAll();
        $intro = $chapterRepository->buildParagraphsByCategory('Skill Intro');
        return $this->render('content/skills.html.twig',[
            'genericParts' => $this->genericParts,
            'path'=>'inc_skill',
            'loop'=>$skills,
            'intro'=>$intro,
        ]);
    }
    /**
     * @Route("/content/skill/{slug}", name="inc_skill")
     */
    public function skill($slug, IncarnateSkillRepository $skillRepository){
        $skill = findInRepository($slug,$skillRepository);
        if(!$skill){
            throw $this->createNotFoundException('The skill: "' . $slug . '" does not exist');
        }
//        $skill = $skillRepository->findOneBy(['fid'=>$slug]);
        return $this->render('content/skill.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
            'skill'=>$skill,
        ]);
    }
}