<?php

namespace App\Repository;

use App\Entity\ChapterIntro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

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

    public function buildParagraphsByArray(array $query,string $category=''):string{
        $result = '';
        $queryCount=count($query);
        if($queryCount==0) {
            return $result;
        }
        if(''==$category&&$query['0']->getCategory()){
            $category = str_replace('-',' ',$query['0']->getCategory());
        }
        if($queryCount>1){
            $result.='<h1 id="top">'.$category.'</h1>';
            foreach ($query as $entry){
                $result.='<p><a href="#'.$entry->getFid().'">'.$entry->getName().'</a></p>';
            }
        }
        foreach ($query as $entry){
            if($queryCount>1){
                $result.='<h1 id="'.$entry->getFid().'"><a href="#top">'.$entry->getName().'</a></h1>';
            }
            $result.=$entry->getDescription();
        }
        return $result;
    }
    public function buildParagraphsByCategory(string $slug):string{
        $category = str_replace('-',' ',$slug);
        $query = $this->findBy(['category'=>$category]);
//        $qb = $this->getOrCreateQueryBuilder();
//        $qb->andWhere('i.category = :category')
//            ->setParameter('category', $category);
//        $qb = $this->selectIncarnateItemFields($qb);
//        $qb = $this->addSelectChapterIntroFields($qb);
//        $query = $qb->getQuery()
//            ->getResult();
        $result = $this->buildParagraphsByArray($query,$category);
        return $result;
    }
    public function buildParagraphsByCategoryFid(string $slug):string{
        $query = $this->findBy(['categoryFid'=>$slug]);
//        $qb = $this->createQueryBuilder('i');
//        $qb->andWhere('i.categoryFid = :categoryfid')
//            ->setParameter('categoryfid', $slug);
//        $qb = $this->selectIncarnateItemFields($qb);
//        $qb = $this->addSelectChapterIntroFields($qb);
//        $query = $qb->getQuery()
//            ->getResult();
        $result = $this->buildParagraphsByArray($query);
        return $result;
    }
    public function arrayOfNonIntroCategories():array{
        $qb = $this->createQueryBuilder('i')
            ->select('i.category','i.official','i.author');
        $queryResult = $qb->getQuery()->getResult();
//        dump($queryResult);die;
        $added = '';
        $result = array();
        foreach ($queryResult as $entry){
            if(false === strpos($added,$entry['category']) && false === strpos($entry['category'],'Intro')){
                $added.=$entry['category'];
                $entry['sanCat'] = str_replace(' ','-',$entry['category']);
                $entry['sanCat'] = str_replace(['(',')'],'',$entry['sanCat']);
                if('false'===$entry['official'] || ''===$entry['official']){
                    $entry['official']=false;
                }elseif ('true'===$entry['official']){
                    $entry['official']=true;
                }
                $result[]=$entry;
            }
        }
        return $result;
    }
    public function deleteAll(){
        return $this->createQueryBuilder('a')
            ->delete()
            ;
    }
    public function headingBuilder(ChapterIntro $query):string{
        if($query->getCategoryFid()){
            return'<h1 id="'.$query->getFid().'"><a href="'.$query->getCategoryFid().'#'.$query->getFid().'">'.$query->getName().'</a></h1>';
        }else{
            return'<h1 id="'.$query->getFid().'">'.$query->getName().'</h1>';
        }
    }
    public function findOneByFid($fid): ?ChapterIntro
    {
        $query = $this->findOneBy(['fid'=>$fid]);
//        $qb = $this->filterByFid($fid);
//        $qb = $this->selectIncarnateItemFields($qb);
//        $query = $this->addSelectChapterIntroFields($qb)
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
        if($query){
            $description=$this->headingBuilder($query);
            $query->setDescription($description.$query->getDescription());
        }
        return $query;
    }
    public function findOneByName($name): ?ChapterIntro
    {
        $name = str_replace('-',' ',$name);
        $query = $this->findOneBy(['name'=>$name]);
//        $qb = $this->filterByName($name);
//        $qb = $this->selectIncarnateItemFields($qb);
//        $query = $this->addSelectChapterIntroFields($qb)
//            ->getQuery()
//            ->setMaxResults(1)
//            ->getOneOrNullResult()
//            ;
        if($query){
            $description=$this->headingBuilder($query);
            $query['description']=$description.$query['description'];
        }
        return $query;
    }
    public function findOneById(int $id): ?ChapterIntro
    {
        $query = $this->find($id);
//        $qb = $this->filterById($id);
//        $qb = $this->selectIncarnateItemFields($qb);
//        $query = $this->addSelectChapterIntroFields($qb)
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
        if(null!=$query->getName()){
            $description=$this->headingBuilder($query);
            $query['description']=$description.$query['description'];
        }
        return $query;
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
