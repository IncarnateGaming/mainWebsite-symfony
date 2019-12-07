<?php

namespace App\Repository;

use App\Entity\IncarnateClassTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateClassTrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateClassTrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateClassTrait[]    findAll()
 * @method IncarnateClassTrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateClassTraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateClassTrait::class);
    }

    // /**
    //  * @return IncarnateClassTrait[] Returns an array of IncarnateClassTrait objects
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
    public function findOneBySomeField($value): ?IncarnateClassTrait
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
