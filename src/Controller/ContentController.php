<?php


namespace App\Controller;


use App\Entity\IncarnateBackground;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
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
     * @Route("/content/background/{slug}")
     */
    public function background($slug){
        $repository = $this->em->getRepository(IncarnateBackground::class);
        if(16 == strlen($slug)){
            $background = $repository->findOneByFid($slug);
            if (null == $background){
                $background = $repository->findOneByName($slug);
            }
        }else{
            $background = $repository->findOneByName($slug);
        }
        return $this->render('content/background.html.twig',[
            'genericParts' => $this->genericParts,
            'background' => $background,
            'slug' => $slug,
        ]);
    }
}