<?php

namespace App\Repository;

use App\Entity\IncarnatePointOfInterest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnatePointOfInterest|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnatePointOfInterest|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnatePointOfInterest[]    findAll()
 * @method IncarnatePointOfInterest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnatePointOfInterestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnatePointOfInterest::class);
    }

    // /**
    //  * @return IncarnatePointOfInterest[] Returns an array of IncarnatePointOfInterest objects
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
    public function findOneBySomeField($value): ?IncarnatePointOfInterest
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
