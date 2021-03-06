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
}
