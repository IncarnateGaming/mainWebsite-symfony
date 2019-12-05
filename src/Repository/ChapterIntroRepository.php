<?php

namespace App\Repository;

use App\Entity\ChapterIntro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ChapterIntro|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChapterIntro|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChapterIntro[]    findAll()
 * @method ChapterIntro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapterIntroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChapterIntro::class);
    }

    // /**
    //  * @return ChapterIntro[] Returns an array of ChapterIntro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChapterIntro
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
