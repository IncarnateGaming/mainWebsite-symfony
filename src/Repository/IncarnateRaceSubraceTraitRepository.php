<?php

namespace App\Repository;

use App\Entity\IncarnateRaceSubraceTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateRaceSubraceTrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateRaceSubraceTrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateRaceSubraceTrait[]    findAll()
 * @method IncarnateRaceSubraceTrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateRaceSubraceTraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateRaceSubraceTrait::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateRaceSubraceTrait[] Returns an array of IncarnateRaceSubraceTrait objects
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
    public function findOneBySomeField($value): ?IncarnateRaceSubraceTrait
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
