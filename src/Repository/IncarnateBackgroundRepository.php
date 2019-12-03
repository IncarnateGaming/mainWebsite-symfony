<?php

namespace App\Repository;

use App\Entity\IncarnateBackground;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
}
