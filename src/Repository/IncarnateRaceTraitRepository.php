<?php

namespace App\Repository;

use App\Entity\IncarnateRaceTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateRaceTrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateRaceTrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateRaceTrait[]    findAll()
 * @method IncarnateRaceTrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateRaceTraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateRaceTrait::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateRaceTrait[] Returns an array of IncarnateRaceTrait objects
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
    public function findOneBySomeField($value): ?IncarnateRaceTrait
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
