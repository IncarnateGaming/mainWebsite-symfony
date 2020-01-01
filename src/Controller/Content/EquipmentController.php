<?php


namespace App\Controller\Content;

use App\Entity\IncarnateEquipment;
use App\Repository\IncarnateEquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
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
     * @Route("/content/equipment/", name="inc_equipments")
     */
    public function equipments(IncarnateEquipmentRepository $equipmentRepository ,Request $request, PaginatorInterface $paginator){
        $term = $request->query->get('q');
        $page = $request->query->getInt('page',1);
        $minValue = $request->query->getInt('minValue',-500);
        $maxValue = $request->query->getInt('maxValue',1000000000);
//        dump($minValue,$maxValue);die;

        $queryBuilder = $equipmentRepository->findAllWithSearchQuery($term,null);
//        if ($minValue !== -500 || $maxValue !== 1000000000 ){
//        $queryBuilder = $equipmentRepository->findAllWithValueQuery($minValue,$maxValue,$queryBuilder);
//        }

        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            30
        );
//        dump($equipment);die;
//        $equipmentRepository = $this->em->getRepository(IncarnateEquipment::class);
        require_once '../lib/php/functions.php';
//        $equipment = findInRepository($slug,$equipmentRepository);
//        $equipment = $equipmentRepository->findAll();
//        $equipment = array();
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'xCbq1QFW5K0WytH1']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'CSSWPLq2MaQZAkvg']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'CyjWCMSgAR1PIWqp']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'BmB1FLQKiixg31EO']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'y3SpRQ8AgAbbUDKo']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'xiAJYXJHCSPxJgOy']);
//        dump($equipment);die;
        if(!$pagination){
            throw $this->createNotFoundException('No equipment found');
        }
        return $this->render('content/equipments.html.twig',[
            'genericParts' => $this->genericParts,
            'pagination'=>$pagination,
        ]);
    }
    /**
     * @Route("/content/equipment/{slug}", name="inc_equipment")
     */
    public function equipment($slug){
        $equipmentRepository = $this->em->getRepository(IncarnateEquipment::class);
        require_once '../lib/php/functions.php';
//        $equipment = findInRepository($slug,$equipmentRepository);
        $equipment = $equipmentRepository->findOneBy(['fid'=>$slug]);
        if(!$equipment){
            throw $this->createNotFoundException('The equipment: "' . $slug . '" does not exist');
        }
        return $this->render('content/equipment.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
            'equipment'=>$equipment,
        ]);
    }
}