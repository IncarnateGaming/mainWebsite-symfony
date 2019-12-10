<?php

namespace App\Repository;

use App\Entity\IncarnateClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateClass[]    findAll()
 * @method IncarnateClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateClass::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateClass[] Returns an array of IncarnateClass objects
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
    public function findOneBySomeField($value): ?IncarnateClass
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
