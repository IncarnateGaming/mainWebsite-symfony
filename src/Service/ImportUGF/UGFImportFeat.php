<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateFeat;

class UGFImportFeat extends BaseUGFImporter
{
    public function import(){
//        $featRepository->deleteAll();
        $featRepository = $this->em->getRepository(IncarnateFeat::class);
        foreach ($this->ugf->chapters->featChapter->feats->feat as $feat){
            $new = $featRepository->findOneBy(['fid'=>$feat['FID']]);
            if(!$new){
                $new = new IncarnateFeat();
            }
            $new->setFid($feat['FID']);
            $new->setType($this->incImportType['feat']);
            $new->setDescription($this->functions->formatParagraphs($feat->featDescription));
            $new->setName($this->functions->quoMark($feat->featname->__toString()));
            $new->setUgfid($feat['featID']);
            $new->setAuthor($feat->author->__toString());
            $new->setOfficial($feat->officialContent->__toString());
            if($feat->featLegal){
                $new->setLegal($this->functions->formatParagraphs($feat->featLegal));
            }
            $new->setPrerequisite($this->functions->headingText($feat->featPrerequisite));
            if($feat->featRecommendedClasses) {
                $recClass = array();
                foreach ($feat->featRecommendedClasses->featRecmmendedClass as $rec) {
                    $recClass[] = $rec->__toString();
                }
                $new->setRecommendedclasses($recClass);
            }
            $this->em->persist($new);
        }
        $this->em->flush();
    }
}