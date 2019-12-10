<?php

namespace App\Repository;

use App\Entity\IncarnateClassArchetypeTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateClassArchetypeTrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateClassArchetypeTrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateClassArchetypeTrait[]    findAll()
 * @method IncarnateClassArchetypeTrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateClassArchetypeTraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateClassArchetypeTrait::class);
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateClassArchetypeTrait[] Returns an array of IncarnateClassArchetypeTrait objects
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
    public function findOneBySomeField($value): ?IncarnateClassArchetypeTrait
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
