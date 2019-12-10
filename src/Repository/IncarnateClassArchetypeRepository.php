<?php

namespace App\Repository;

use App\Entity\IncarnateClassArchetype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateClassArchetype|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateClassArchetype|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateClassArchetype[]    findAll()
 * @method IncarnateClassArchetype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateClassArchetypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateClassArchetype::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateClassArchetype[] Returns an array of IncarnateClassArchetype objects
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
    public function findOneBySomeField($value): ?IncarnateClassArchetype
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
