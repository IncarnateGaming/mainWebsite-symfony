<?php


namespace App\Service\ImportUGF;


use App\Entity\ChapterIntro;
use App\Entity\IncarnateItem;

class UGFImportChapterIntro extends BaseUGFImporter
{

    public function assembleSections(\SimpleXMLElement $sec1,string $top='top'):string {
        $result='';
//        $result = '<h1 id="' . $sec1['FID'] . '">' . $this->functions->heading1($sec1->heading1,$top) . '</h1>';
        if(count($sec1->section2)>1){
            foreach ($sec1->section2 as $sec2) {
                $result.='<p>'.$this->functions->heading2($sec2->heading2,$sec2['FID']).'</p>';
            }
        }
        foreach($sec1->paragraph as $par){
            $result.=$this->functions->formatParagraphs($par);
        }
        foreach($sec1->section2 as $sec2){
            $result .= '<h2 id="'.$sec2['FID'].'">'.$this->functions->heading2($sec2->heading2,$sec1['FID']).'</h2>';
            if(count($sec2->section3)>1){
                foreach ($sec2->section3 as $sec3){
                    $result.='<p>'.$this->functions->heading3($sec3->heading3,$sec3['FID']).'</p>';
                }
            }
            foreach($sec2->paragraph as $par){
                $result.=$this->functions->formatParagraphs($par);
            }
            foreach ($sec2->section3 as $sec3){
                $result.='<h3 id="'.$sec3['FID'].'">'.$this->functions->heading3($sec3->heading3,$sec2['FID']).'</h3>';
                if(count($sec3->section4)>1){
                    foreach ($sec3->section4 as $sec4){
                        $result.='<p>'.$this->functions->heading4($sec4->heading4,$sec4['FID']).'</p>';
                    }
                }
                foreach($sec3->paragraph as $par){
                    $result.=$this->functions->formatParagraphs($par);
                }
                foreach ($sec3->section4 as $sec4){
                    $result.='<h4 id="'.$sec4['FID'].'">'.$this->functions->heading4($sec4->heading4,$sec3['FID']).'</h4>';
                    if(count($sec4->section5)>1){
                        foreach ($sec4->section5 as $sec5){
                            $result.='<p>'.$this->functions->heading5($sec5->heading5,$sec5['FID']).'</p>';
                        }
                    }
                    foreach($sec4->paragraph as $par){
                        $result.=$this->functions->formatParagraphs($par);
                    }
                    foreach ($sec4->section5 as $sec5){
                        $result.='<h5 id="'.$sec5['FID'].'">'.$this->functions->heading5($sec5->heading5,$sec5['FID']).'</h5>';
                        if(count($sec5->section6)>1){
                            foreach ($sec5->section6 as $sec6){
                                $result.='<p>'.$this->functions->heading6($sec6->heading6,$sec6['FID']).'</p>';
                            }
                        }
                        foreach($sec5->paragraph as $par){
                            $result.=$this->functions->formatParagraphs($par);
                        }
                        foreach ($sec5->section6 as $sec6){
                            $result.='<h6 id="'.$sec6['FID'].'">'.$this->functions->heading6($sec6->heading6,$sec6['FID']).'</h6>';
                            foreach($sec6->paragraph as $par){
                                $result.=$this->functions->formatParagraphs($par);
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }
    public function prepareChapterIntro(\SimpleXMLElement $chapter, string $category = null,string $categoryfid=null){
        $category= str_replace(['(',')','-'],'',$category);
        if(!$chapter){
            return false;
        }
        if($chapter->GMOnly){
            if('true'==$chapter->GMOnly->__toString()){
                return false;
            }
        }
        $top='top';
        if(strpos($category,'Intro')!==false){
            $top='';
        }
        foreach ($chapter->sections->section1 as $sec1) {
            $new = $this->em->getRepository(ChapterIntro::class)->findOneBy(['fid'=>$sec1['FID']]);
            if(!$new) {
                $new = new ChapterIntro();
            }
            $sections = $this->assembleSections($sec1,$top);
            if($category) {
                $new->setCategory($category);
            }
            $new->setDescription($sections);
            $new->setName($this->functions->heading1($sec1->heading1));
            $new->setFid($sec1['FID']);
            if($categoryfid){
                $new->setCategoryFid($categoryfid);
            }
            if ($chapter->officialContent) {
                if('true'==$chapter->officialContent){
                    $new->setOfficial(true);
                    $new->setAuthor('SRD');
                }else{
                    $new->setOfficial(false);
                    $new->setAuthor('ProNobis');
                }
            }else{
                $new->setOfficial(false);
                $new->setAuthor('ProNobis');
            }
            if ($sec1['simpleName']) {
                $new->setSimpleName($sec1['simpleName']);
            }
            if ($sec1['template']) {
                $new->setTemplate(boolval($sec1['template']));
            }else{
                $new->setTemplate(false);
            }
            $new->setType($this->incImportType['rule']);
            $new->setUgfid($sec1['secID']);
            $this->em->persist($new);
        }
        return true;
    }
    public function makeChapterCategories(\SimpleXMLElement $chapters){
        foreach ($chapters as $chapter){
            $new = $this->em->getRepository(IncarnateItem::class)->findOneBy(['fid'=>$chapter['FID']]);
            if(!$new) {
                $new = new IncarnateItem();
            }
            $new->setDescription('');
            $new->setLegal('');
            $author = $chapter->officialContent->__toString() === 'true' ? 'SRD' : 'ProNobis';
            $new->setAuthor($author);
            $new->setName($chapter->chapterName->__toString());
            $new->setFid($chapter['FID']);
            $new->setUgfid($chapter['miscellaneousChapterID']);
            $new->setType($this->incImportType['rule']);
            $official = $chapter->officialContent->__toString() === 'true' ? true : false;
            $new->setOfficial($official);
            $this->em->persist($new);
        }
        return true;
    }
    public function import(){
        $repository = $this->em->getRepository(ChapterIntro::class);
        $repository->deleteAll()->getQuery()->execute();
        $this->prepareChapterIntro($this->ugf->chapters->GMsBlind,'GMs Screen');
        $this->prepareChapterIntro($this->ugf->chapters->PlayerQuickSheet,'Player Quick Sheet');
        $this->prepareChapterIntro($this->ugf->chapters->frontMatter->legal,'Legal',$this->ugf->chapters->frontMatter->legal['FID']);
        $this->prepareChapterIntro($this->ugf->chapters->frontMatter->introduction,'Introduction',$this->ugf->chapters->frontMatter->indroduction['FID']);
        $this->prepareChapterIntro($this->ugf->chapters->backgroundChapter->backgroundsIntroduction,'Background Intro');
        $this->prepareChapterIntro($this->ugf->chapters->classChapter->classIntroduction,'Class Intro');
        $this->prepareChapterIntro($this->ugf->chapters->featChapter->featsIntroduction,'Feat Intro');
        $this->prepareChapterIntro($this->ugf->chapters->itemChapter->itemsIntroduction,'Equipment Intro');
        $this->prepareChapterIntro($this->ugf->chapters->magicitemTemplatesChapter->magicItemTemplatesIntroduction,'Magical Properties Intro');
        $this->prepareChapterIntro($this->ugf->chapters->npcChapter->npcsIntroduction,'NPC Intro');
        $this->prepareChapterIntro($this->ugf->chapters->planeChapter->planesIntroduction,'Lore Intro');
        $this->prepareChapterIntro($this->ugf->chapters->racesChapter->racesIntroduction,'Race Intro');
        $this->prepareChapterIntro($this->ugf->chapters->riddlesChapter->riddlesIntroduction,'Riddle Intro');
        $this->prepareChapterIntro($this->ugf->chapters->skillsChapter->skillsIntroduction,'Skill Intro');
        $this->prepareChapterIntro($this->ugf->chapters->spellsChapter->spellsIntroduction,'Spell Intro');
        foreach($this->ugf->chapters->miscellaneousChapters->miscellaneousChapter as $chapter){
            $this->prepareChapterIntro($chapter,$chapter->chapterName->__toString(),$chapter['FID']);
        }
        $this->makeChapterCategories($this->ugf->chapters->miscellaneousChapters->miscellaneousChapter);
        $this->em->flush();
        return true;
    }
}