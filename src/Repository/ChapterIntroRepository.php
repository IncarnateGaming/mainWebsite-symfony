<?php

namespace App\Repository;

use App\Entity\ChapterIntro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method ChapterIntro|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChapterIntro|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChapterIntro[]    findAll()
 * @method ChapterIntro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapterIntroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChapterIntro::class);
    }

    public function buildParagraphsByCategory(string $category):string{
        $qb = $this->getOrCreateQueryBuilder();
        $qb->andWhere('i.category = :category')
            ->setParameter('category', $category);
        $qb = $this->selectIncarnateItemFields($qb);
        $qb = $this->addSelectChapterIntroFields($qb);
        $query = $qb->getQuery()
            ->getResult();
        $result = '';
        if(count($query)>1){
            $result.='<i id="top"></i>';
            foreach ($query as $entry){
                $result.='<p><a href="#'.$entry['fid'].'">'.$entry['name'].'</a></p>';
            }
        }
        foreach ($query as $entry){
            $result.=$entry['description'];
        }
        return $result;
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }
    public function findOneByFid($fid)//: ?IncarnateBackgroundFeature
    {
        $qb = $this->filterByFid($fid);
        $qb = $this->selectIncarnateItemFields($qb);
        return $this->addSelectChapterIntroFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findOneByName($name)//: ?IncarnateBackgroundFeature
    {
        $name = str_replace('-',' ',$name);
        $qb = $this->filterByName($name);
        $qb = $this->selectIncarnateItemFields($qb);
        return $this->addSelectChapterIntroFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findOneById(int $id)//: ?IncarnateBackgroundFeature
    {
        $qb = $this->filterById($id);
        $qb = $this->selectIncarnateItemFields($qb);
        return $this->addSelectChapterIntroFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    private function addSelectChapterIntroFields(QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->addSelect('i.template','i.simpleName','i.category');
    }

    // /**
    //  * @return ChapterIntro[] Returns an array of ChapterIntro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChapterIntro
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    private function filterByFid($fid,QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('i.fid = :fid')
            ->setParameter('fid', $fid);
    }
    private function filterByName($name,QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('i.name = :name')
            ->setParameter('name', $name);
    }
    private  function getOrCreateQueryBuilder(QueryBuilder $qb = null){
        return $qb ?: $this->createQueryBuilder('i');
    }
    private function selectIncarnateItemFields(QueryBuilder $qb = null){
        return $this->getOrCreateQueryBuilder($qb)
            ->select('i.id','i.fid','i.ugfid','i.name','i.description','i.author','i.official','i.legal','i.type');
    }
    private function filterById(int $id,QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('i.id = :id')
            ->setParameter('id', $id);
    }
}
