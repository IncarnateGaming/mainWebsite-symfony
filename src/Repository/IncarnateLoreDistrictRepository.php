<?php

namespace App\Repository;

use App\Entity\IncarnateLoreDistrict;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateLoreDistrict|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateLoreDistrict|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateLoreDistrict[]    findAll()
 * @method IncarnateLoreDistrict[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateLoreDistrictRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateLoreDistrict::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateLoreDistrict[] Returns an array of IncarnateLoreDistrict objects
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
    public function findOneBySomeField($value): ?IncarnateLoreDistrict
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
