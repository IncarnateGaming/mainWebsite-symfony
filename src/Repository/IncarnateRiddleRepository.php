<?php

namespace App\Repository;

use App\Entity\IncarnateRiddle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateRiddle|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateRiddle|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateRiddle[]    findAll()
 * @method IncarnateRiddle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateRiddleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateRiddle::class);
    }

    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }
    // /**
    //  * @return IncarnateRiddle[] Returns an array of IncarnateRiddle objects
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
    public function findOneBySomeField($value): ?IncarnateRiddle
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
