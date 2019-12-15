<?php


namespace App\Controller\Content;

use App\Entity\IncarnateEquipment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function equipments(){
        $equipmentRepository = $this->em->getRepository(IncarnateEquipment::class);
        require_once '../lib/php/functions.php';
//        $equipment = findInRepository($slug,$equipmentRepository);
        $equipment = $equipmentRepository->findAll();
//        $equipment = array();
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'xCbq1QFW5K0WytH1']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'CSSWPLq2MaQZAkvg']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'CyjWCMSgAR1PIWqp']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'BmB1FLQKiixg31EO']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'y3SpRQ8AgAbbUDKo']);
//        $equipment[]=$equipmentRepository->findOneBy(['fid'=>'xiAJYXJHCSPxJgOy']);
//        dump($equipment);die;
        if(!$equipment){
            throw $this->createNotFoundException('No equipment found');
        }
        return $this->render('content/equipments.html.twig',[
            'genericParts' => $this->genericParts,
            'equipment'=>$equipment,
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