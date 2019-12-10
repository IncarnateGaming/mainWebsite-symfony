<?php

namespace App\Repository;

use App\Entity\IncarnateFeat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateFeat|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateFeat|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateFeat[]    findAll()
 * @method IncarnateFeat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateFeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateFeat::class);
    }

    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateFeat[] Returns an array of IncarnateFeat objects
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
    public function findOneBySomeField($value): ?IncarnateFeat
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
