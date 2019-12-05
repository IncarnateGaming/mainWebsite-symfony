<?php


namespace App\Controller;


use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;
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
        $backgroundRepository = $this->em->getRepository(IncarnateBackground::class);
        if(16 == strlen($slug)){
            $background = $backgroundRepository->findOneByFid($slug);
            if (null == $background){
                $background = $backgroundRepository->findOneByName($slug);
            }
        }else{
            $background = $backgroundRepository->findOneByName($slug);
        }
        $backgroundFeature = null;
        if($background['featurefid']){
            $backgroundFeatureRepository = $this->em->getRepository(IncarnateBackgroundFeature::class);
            $backgroundFeature = $backgroundFeatureRepository->findOneByFid($background['featurefid']);
        }
        return $this->render('content/background.html.twig',[
            'genericParts' => $this->genericParts,
            'background' => $background,
            'slug' => $slug,
            'feature' =>$backgroundFeature,
        ]);
    }
}