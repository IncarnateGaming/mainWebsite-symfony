<?php

namespace App\Repository;

use App\Entity\IncarnateEquipmentPack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateEquipmentPack|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateEquipmentPack|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateEquipmentPack[]    findAll()
 * @method IncarnateEquipmentPack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateEquipmentPackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateEquipmentPack::class);
    }

    // /**
    //  * @return IncarnateEquipmentPack[] Returns an array of IncarnateEquipmentPack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IncarnateEquipmentPack
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
