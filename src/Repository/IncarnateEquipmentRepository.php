<?php

namespace App\Repository;

use App\Entity\IncarnateEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

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

    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }

    /**
     * @param string|null $term
     * @return IncarnateEquipment[]
     */
    public function createOrPassQueryBuilder(?QueryBuilder $qb):QueryBuilder{
        if (!$qb){
            $qb = $this->createQueryBuilder('a');
        }
        return $qb;
    }
    public function findAllWithSearchQuery(?string $term, ?QueryBuilder $qb):QueryBuilder{
        $qb = $this->createOrPassQueryBuilder($qb);
        if($term){
            $qb->andWhere('a.name LIKE :term OR a.damage LIKE :term OR a.description LIKE :term')
                ->setParameter('term','%'.$term.'%')
                ;
        }
        return $qb
            ;
    }
    public function findAllWithValueQuery(?int $min, ?int $max, ?QueryBuilder $qb):QueryBuilder{
        $qb = $this->createOrPassQueryBuilder($qb);
        if($min){
            $qb->andWhere('a.costSortable >= :minValue')
                ->setParameter('minValue','%'.$min.'%')
                ;
        }
        if($max){
            $qb->andWhere('a.costSortable <= :maxValue')
                ->setParameter('maxValue','%'.$max.'%')
                ;
        }
        return $qb
            ;
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
