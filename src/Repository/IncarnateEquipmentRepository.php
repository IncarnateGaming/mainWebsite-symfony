<?php

namespace App\Repository;

use App\Entity\IncarnateEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncarnateEquipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnateEquipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnateEquipment[]    findAll()
 * @method IncarnateEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnateEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnateEquipment::class);
    }

    // /**
    //  * @return IncarnateEquipment[] Returns an array of IncarnateEquipment objects
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
    public function findOneBySomeField($value): ?IncarnateEquipment
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
