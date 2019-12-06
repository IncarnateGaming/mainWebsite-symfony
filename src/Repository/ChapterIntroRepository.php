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
        if($queryCount==0){
            return $result;
        }
        if(''==$category&&$query['0']['category']){
            $category = str_replace('-',' ',$query['0']['category']);
        }
        if($queryCount>1){
            $result.='<h1 id="top">'.$category.'</h1>';
            foreach ($query as $entry){
                $result.='<p><a href="#'.$entry['fid'].'">'.$entry['name'].'</a></p>';
            }
        }
        foreach ($query as $entry){
            if($queryCount>1){
                $result.='<h1 id="'.$entry['fid'].'"><a href="#top">'.$entry['name'].'</a></h1>';
            }
            $result.=$entry['description'];
        }
        return $result;
    }
    public function buildParagraphsByCategory(string $slug):string{
        $category = str_replace('-',' ',$slug);
        $qb = $this->getOrCreateQueryBuilder();
        $qb->andWhere('i.category = :category')
            ->setParameter('category', $category);
        $qb = $this->selectIncarnateItemFields($qb);
        $qb = $this->addSelectChapterIntroFields($qb);
        $query = $qb->getQuery()
            ->getResult();
        $result = $this->buildParagraphsByArray($query,$category);
        return $result;
    }
    public function buildParagraphsByCategoryFid(string $slug):string{
        $qb = $this->getOrCreateQueryBuilder();
        $qb->andWhere('i.categoryFid = :categoryfid')
            ->setParameter('categoryfid', $slug);
        $qb = $this->selectIncarnateItemFields($qb);
        $qb = $this->addSelectChapterIntroFields($qb);
        $query = $qb->getQuery()
            ->getResult();
        $result = $this->buildParagraphsByArray($query);
        return $result;
    }
    public function arrayOfNonIntroCategories():array{
        $qb = $this->getOrCreateQueryBuilder()
            ->select('i.category','i.official','i.author');
        $queryResult = $qb->getQuery()->getResult();
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
    public function headingBuilder(array $query):string{
        if($query['categoryFid']){
            return'<h1 id="'.$query['fid'].'"><a href="'.$query['categoryFid'].'#'.$query['fid'].'">'.$query['name'].'</a></h1>';
        }else{
            return'<h1 id="'.$query['fid'].'">'.$query['name'].'</h1>';
        }
    }
    public function findOneByFid($fid)//: ?IncarnateBackgroundFeature
    {
        $qb = $this->filterByFid($fid);
        $qb = $this->selectIncarnateItemFields($qb);
        $query = $this->addSelectChapterIntroFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
        if(null!=$query['name']){
            $description=$this->headingBuilder($query);
            $query['description']=$description.$query['description'];
        }
        return $query;
    }
    public function findOneByName($name)//: ?IncarnateBackgroundFeature
    {
        $name = str_replace('-',' ',$name);
        $qb = $this->filterByName($name);
        $qb = $this->selectIncarnateItemFields($qb);
        $query = $this->addSelectChapterIntroFields($qb)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
            ;
        if(null!=$query['name']){
            $description=$this->headingBuilder($query);
            $query['description']=$description.$query['description'];
        }
        return $query;
    }
    public function findOneById(int $id)//: ?IncarnateBackgroundFeature
    {
        $qb = $this->filterById($id);
        $qb = $this->selectIncarnateItemFields($qb);
        $query = $this->addSelectChapterIntroFields($qb)
            ->getQuery()
            ->getOneOrNullResult()
            ;
        if(null!=$query['name']){
            $description=$this->headingBuilder($query);
            $query['description']=$description.$query['description'];
        }
        return $query;
    }
    private function addSelectChapterIntroFields(QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->addSelect('i.template','i.simpleName','i.category','i.categoryFid');
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
    private function filterByFid($fid,QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('i.fid = :fid')
            ->setParameter('fid', $fid);
    }
    private function filterByName($name,QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('i.name = :name')
            ->setParameter('name', $name);
    }
    private  function getOrCreateQueryBuilder(QueryBuilder $qb = null){
        return $qb ?: $this->createQueryBuilder('i');
    }
    private function selectIncarnateItemFields(QueryBuilder $qb = null){
        return $this->getOrCreateQueryBuilder($qb)
            ->select('i.id','i.fid','i.ugfid','i.name','i.description','i.author','i.official','i.legal','i.type');
    }
    private function filterById(int $id,QueryBuilder $qb=null){
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('i.id = :id')
            ->setParameter('id', $id);
    }
}
