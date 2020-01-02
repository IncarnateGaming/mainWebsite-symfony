<?php

namespace App\Repository;

use App\Entity\IncarnateLorePlane;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateLorePlane|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateLorePlane|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateLorePlane[]    findAll()
 * @method IncarnateLorePlane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateLorePlaneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateLorePlane::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateLorePlane[] Returns an array of IncarnateLorePlane objects
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
    public function findOneBySomeField($value): ?IncarnateLorePlane
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
