<?php


namespace App\Controller\Content;


use App\Repository\IncarnateTableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
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
     * @Route("/content/table/", name="inc_tables")
     */
    public function tables(IncarnateTableRepository $incarnateTableRepository){
        $tables = $incarnateTableRepository->findAll();
        return $this->render('content/tables.html.twig',[
            'genericParts' => $this->genericParts,
            'loop' => $tables,
            'intro'=>null,
            'path'=>'inc_table',
        ]);
    }
    /**
     * @Route("/content/table/{slug}", name="inc_table")
     */
    public function table($slug, IncarnateTableRepository $incarnateTableRepository){
        $table = $incarnateTableRepository->findOneBy(['fid'=>$slug]);
//        $table = findInRepository($slug,$incarnateTableRepository);
        if (!$table){
            throw $this->createNotFoundException('The table: "' . $slug . '" does not exist');
        }
        return $this->render('content/table.html.twig',[
            'genericParts' => $this->genericParts,
            'slug' => $slug,
            'table'=>$table,
        ]);
    }
}