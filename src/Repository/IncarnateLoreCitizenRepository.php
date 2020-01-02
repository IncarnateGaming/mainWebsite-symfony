<?php

namespace App\Repository;

use App\Entity\IncarnateLoreCitizen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateLoreCitizen|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateLoreCitizen|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateLoreCitizen[]    findAll()
 * @method IncarnateLoreCitizen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateLoreCitizenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateLoreCitizen::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateLoreCitizen[] Returns an array of IncarnateLoreCitizen objects
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
    public function findOneBySomeField($value): ?IncarnateLoreCitizen
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
