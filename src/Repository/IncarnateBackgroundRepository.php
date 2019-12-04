<?php

namespace App\Repository;

use App\Entity\IncarnateBackground;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method IncarnateBackground|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateBackground|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateBackground[]    findAll()
 * @method IncarnateBackground[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateBackgroundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateBackground::class);
    }

    public function findOneByFid($fid)//: ?IncarnateBackground
    {
        return $this->filterByFid($fid)
            ->andWhere('i.fid = :fid')
            ->setParameter('fid', $fid)
            ->select('i.author','i.bondfid','i.featurefid','i.flawfid','i.gp','i.idealfid','i.languages','i.legal','i.official','i.personalityfid','i.skillProf','i.startEq','i.toolProf','i.type','i.ugfid')
            ->addSelect('i.id','i.fid','i.name','i.description')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return IncarnateBackground[] Returns an array of IncarnateBackground objects
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
    public function findOneBySomeField($value): ?IncarnateBackground
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
    private  function getOrCreateQueryBuilder(QueryBuilder $qb = null){
        return $qb ?: $this->createQueryBuilder('i');
    }
}
