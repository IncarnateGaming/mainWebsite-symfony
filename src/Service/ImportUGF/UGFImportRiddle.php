<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateRiddle;

class UGFImportRiddle extends BaseUGFImporter
{
    public function import(){
//        $riddleRepository->deleteAll()->getQuery()->execute();
//        dump($this->incImportType);die;
        $riddleRepository = $this->em->getRepository(IncarnateRiddle::class);
        foreach ($this->ugf->chapters->riddlesChapter->riddles->riddle as $riddle){
            $new = $riddleRepository->findOneBy(['fid'=>$riddle['FID']]);
            if(!$new){
                $new = new IncarnateRiddle();
            }
            $new->setAnswer($this->functions->formatParagraphs($riddle->riddleAnswer));
            $new->setAuthor($riddle->author->__toString());
            $new->setDescription($this->functions->formatParagraphs($riddle->riddleDescription));
            $new->setFid($riddle['FID']);
            $new->setLegal($this->functions->headingText(str_replace(['<riddleSource>','</riddleSource>'],'',$riddle->riddleSource->asXML())));
            $new->setName($riddle->riddleName->__toString());
            $new->setOfficial('false');
            $new->setRiddleType($riddle->riddleType->__toString());
            $new->setType($this->incImportType['riddle']);
            $new->setUgfid($riddle['riddleID']);
            $this->em->persist($new);
        }
        $this->em->flush();
    }
}