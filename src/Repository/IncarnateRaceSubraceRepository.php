<?php

namespace App\Repository;

use App\Entity\IncarnateRaceSubrace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateRaceSubrace|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateRaceSubrace|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateRaceSubrace[]    findAll()
 * @method IncarnateRaceSubrace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateRaceSubraceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateRaceSubrace::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateRaceSubrace[] Returns an array of IncarnateRaceSubrace objects
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
    public function findOneBySomeField($value): ?IncarnateRaceSubrace
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
