<?php

namespace App\Repository;

use App\Entity\IncarnateBackgroundFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method IncarnateBackgroundFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateBackgroundFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateBackgroundFeature[]    findAll()
 * @method IncarnateBackgroundFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateBackgroundFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateBackgroundFeature::class);
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
        return $this->addSelectBackgroundFeatureFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findOneByName($name)//: ?IncarnateBackgroundFeature
    {
        $name = str_replace('-',' ',$name);
        $qb = $this->filterByName($name);
        $qb = $this->selectIncarnateItemFields($qb);
        return $this->addSelectBackgroundFeatureFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findOneById(int $id)//: ?IncarnateBackgroundFeature
    {
        $qb = $this->filterById($id);
        $qb = $this->selectIncarnateItemFields($qb);
        return $this->addSelectBackgroundFeatureFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    private function addSelectBackgroundFeatureFields(QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->addSelect('i.parentfid','i.parentname');
    }
    // /**
    //  * @return IncarnateBackgroundFeature[] Returns an array of IncarnateBackgroundFeature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IncarnateBackgroundFeature
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
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
