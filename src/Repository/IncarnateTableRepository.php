<?php

namespace App\Repository;

use App\Entity\IncarnateTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method IncarnateTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateTable[]    findAll()
 * @method IncarnateTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateTable::class);
    }

    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }
    // /**
    //  * @return IncarnateTable[] Returns an array of IncarnateTable objects
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
    public function findOneBySomeField($value): ?IncarnateTable
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
