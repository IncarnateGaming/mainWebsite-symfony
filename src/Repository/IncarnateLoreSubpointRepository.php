<?php

namespace App\Repository;

use App\Entity\IncarnateLoreSubpoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateLoreSubpoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateLoreSubpoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateLoreSubpoint[]    findAll()
 * @method IncarnateLoreSubpoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateLoreSubpointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateLoreSubpoint::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateLoreSubpoint[] Returns an array of IncarnateLoreSubpoint objects
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
    public function findOneBySomeField($value): ?IncarnateLoreSubpoint
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
