<?php

namespace App\Repository;

use App\Entity\IncarnateItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateItem[]    findAll()
 * @method IncarnateItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateItem::class);
    }

    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    // /**
    //  * @return IncarnateItem[] Returns an array of IncarnateItem objects
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
    public function findOneBySomeField($value): ?IncarnateItem
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