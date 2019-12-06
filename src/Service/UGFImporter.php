<?php


namespace App\Service;


use App\Entity\ChapterIntro;
use App\Entity\DeleteMe;
use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;
use App\Entity\IncarnateTable;
use Doctrine\ORM\EntityManagerInterface;


class UGFImporter
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->ugfFilePath = '../lib/xml/Incarnate-System.xml';
        $this->ugf = simplexml_load_file($this->ugfFilePath);
    }
    public function wrapInInternalHyperlink(string $string, string $fid){
        return '<a href="#'.$fid.'">'.$string.'</a>';
    }
    public function heading1(\SimpleXMLElement $xml,string $fid=null):string{
        $string = $this->headingText(str_replace(['<heading1>','</heading1>'],'',$xml->asXML()));
        if(''!==$fid){
            $string=$this->wrapInInternalHyperlink($string,$fid);
        }
        return $string;
    }
    public function heading2(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading2>','</heading2>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading3(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading3>','</heading3>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading4(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading4>','</heading4>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading5(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading5>','</heading5>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading6(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading6>','</heading6>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function headingText(string $string):string{
        $string = str_replace('<quoMark/>','"',$string);
        $string = str_replace('<generate','<span class="generate"',$string);
        $string = str_replace(' FID="',' data-FID="',$string);
        $string = str_replace(' UGFLinkReference="',' data-UGFLinkReference="',$string);
        $string = str_replace(' FIDparent="',' data-FIDparent="',$string);
        $string = str_replace(' UGFparent="',' data-UGFparent="',$string);
        $string = str_replace(' recurrance="',' data-recurrance="',$string);
        $string = str_replace(' quantity="',' data-quantity="',$string);
        $string = str_replace('</generate>','</span>',$string);
        return $string;
    }
    //Takes either a string or a description simple xml element
    public function richText($string):string{
        if (is_string($string)){
            $result = $string;
        }elseif ( is_a($string,'SimpleXMLElement') ){
            $result = $string->asXML();
            $result = str_replace('<description>','',$result);
            $result = str_replace('</description>','',$result);
        }
        //TODO: handle sound
        $result = str_replace('<quoMark/>','"',$result);
        $result = str_replace('<calculate>','<span class="calculate">',$result);
        $result = str_replace('</calculate>','</span>',$result);
        $result = str_replace('<crossReference','<span class="crossReference"',$result);
        $result = str_replace(' FID="',' data-FID="',$result);
        $result = str_replace(' UGFLinkReference="',' data-UGFLinkReference="',$result);
        $result = str_replace(' FIDparent="',' data-FIDparent="',$result);
        $result = str_replace(' UGFparent="',' data-UGFparent="',$result);
        $result = str_replace('</crossReference>','</span>',$result);
        $result = str_replace('<generate','<span class="generate"',$result);
        $result = str_replace(' recurrance="',' data-recurrance="',$result);
        $result = str_replace(' quantity="',' data-quantity="',$result);
        $result = str_replace('</generate>','</span>',$result);
        $result = str_replace('<hyperlink uri="','<a href="',$result);
        $result = str_replace('</hyperlink>','</a>',$result);
        return $result;
    }
    public function formatParagraphs(\SimpleXMLElement $xml):string {
        $result = "";
        $children = $xml->children();
        foreach ($children as $child){
            $result .= $child->asXML();
        }
        $result = str_replace('<centeredText>','<p class="text-center">',$result);
        $result = str_replace('</centeredText>','</p>',$result);
        $result = str_replace('<empahaticParagraph>','<p class="border border-primary rounded bg-dark">',$result);
        $result = str_replace('</emphaticParagraph>','</p>',$result);
        $headers = array('<h>','<h sublevel="1">','<h sublevel="2">','<h sublevel="3">','<h sublevel="4">','<h sublevel="5">','<h sublevel="6">');
        $result = str_replace($headers, '<h3>',$result);
        $result = str_replace('</h>','</h3>',$result);
        //TODO: handle image
        //TODO: handle private Paragraph
        //TODO: handle speech bubble
        //TODO: confirm normal tables work
        $result = $this->richText($result);
        return $result;
    }
    public function importBackgrounds(){
        $backgrounds = $this->ugf->chapters->backgroundChapter->backgrounds;
        $repository = $this->em->getRepository(IncarnateBackground::class);
        $repository->deleteAll()->getQuery()->execute();
        foreach ($backgrounds->children() as $background){
            $back = new IncarnateBackground();
            $back->setAuthor($background->backgroundAuthor);
            $back->setBondfid($background->backgroundSuggestedCharacteristics->backgroundBond['FID']);
            $description = $this->formatParagraphs($background->backgroundDescription);
            $back->setDescription($description);
            $back->setFeaturefid($background->backgroundFeature['FID']);
            $back->setFid($background['FID']);
            $back->setFlawfid($background->backgroundSuggestedCharacteristics->backgroundFlaw['FID']);
            $back->setGp(intval($background->backgroundGP));
            $back->setIdealfid($background->backgroundSuggestedCharacteristics->backgroundIdeal['FID']);
            if ($background->backgroundLanguages){
                $languages = $background->backgroundLanguages->children();
                $lanresult = array();
                foreach ($languages as $language){
                    $lanresult[] = $language->__toString();
                }
                $back->setLanguages($lanresult);
            }
            if ($background->backgroundLegal){
                $legal = $this->formatParagraphs($background->backgroundLegal);
                $back->setLegal($legal);
            }
            $back->setName($background->backgroundName);
            $back->setOfficial($background->officialContent);
            $back->setPersonalityfid($background->backgroundSuggestedCharacteristics->backgroundPersonality['FID']);
            $skillProficiencies = $background->backgroundSkillProficiencies->description->children();
            $skillProfRes = array();
            foreach ($skillProficiencies as $skillProficiency){
                $skillArray = array(
                    'name' => $skillProficiency->__toString(),
                    'fid' => $skillProficiency['FID']->__toString(),
                    'ugf' => $skillProficiency['UGFLinkReference']->__toString(),
                );
                $skillProfRes[] = $skillArray;
            }
            $back->setSkillProf($skillProfRes);
            $startingEquipRes = array(
                'itemArray'=>array(),
                'description'=>$this->richText($background->backgroundStartingEquipment->description),
            );
            $startEquipItems = $background->backgroundStartingEquipment->defaultChoices->children();
            foreach ($startEquipItems as $item){
                $itemFormat = array(
                    'name'=>$item->inculdedItemName->__toString(),
                    'quantity'=>intval($item->inculdedItemQuantity->__toString()),
                    'fid'=>$item['FID']->__toString(),
                    'ugf' => $item['UGFLinkReference']->__toString(),
                );
                $startingEquipRes['itemArray'][] = $itemFormat;
            }
            $back->setStartEq($startingEquipRes);
            $suggestedChar = $this->formatParagraphs($background->backgroundSuggestedCharacteristics->backgroundCharacteristicsDescription);
            $back->setSuggestedCharIntro($suggestedChar);
            if ($background->backgroundToolProficiencies){
                $toolArray = array(
                    'description'=> '<p>' . $this->richText($background->backgroundToolProficiencies->description) . '</p>',
                    'tools'=> array(),
                );
                if ($background->backgroundToolProficiencies->description->crossReference){
                    foreach ($background->backgroundToolProficiencies->description->children() as $tool){
                        $toArray = array(
                            'name'=> $tool->__toString(),
                            'fid'=> $tool['FID']->__toString(),
                            'ugf' => $tool['UGFLinkReference']->__toString(),
                        );
                        $toolArray['tools'][] = $toArray;
                    }
                }
                $back->setToolProf($toolArray);
            }
            $back->setType('background');
            $back->setUgfid($background['backgroundID']);
            $this->em->persist($back);
        }
        $this->em->flush();
        return true;
    }
    public function importBackgroundFeatures(){
        $backgrounds = $this->ugf->chapters->backgroundChapter->backgrounds;
        $repository = $this->em->getRepository(IncarnateBackgroundFeature::class);
        $repository->deleteAll()->getQuery()->execute();
        foreach ($backgrounds->children() as $background){
//            dump($background);die;
            $backFeat = new IncarnateBackgroundFeature();
            $backFeat->setAuthor($background->backgroundAuthor);
            $description = $this->formatParagraphs($background->backgroundFeature->backgroundFeatureDescription);
            $backFeat->setDescription($description);
            $backFeat->setFid($background->backgroundFeature['FID']);
            if ($background->backgroundLegal){
                $legal = $this->formatParagraphs($background->backgroundLegal);
                $backFeat->setLegal($legal);
            }
            $backFeat->setName($background->backgroundFeature->backgroundFeatureName);
            $backFeat->setOfficial($background->officialContent);
            $backFeat->setParentfid($background['FID']);
            $backFeat->setParentname($background->backgroundName);
            $backFeat->setType('backgroundFeature');
            $backFeat->setUgfid($background->backgroundFeature['backgroundFeatureID']);
            $this->em->persist($backFeat);
        }
        $this->em->flush();
        return true;
    }
    public function prepareTableRows(\SimpleXMLElement $table):array{
        $xmlRows = $table->xpath("./tr");
        $rowArray = array();
        foreach ($xmlRows as $row){
            $newRow = array(
                'from' => intval($row->rollfrom->__toString()),
                'to' => intval($row->rollto->__toString()),
                'td' => array(),
            );
            $replaceArray = array('<td>','</td>',"\t","\n","\r",'<th>','</th>');
            foreach ($row->td as $column){
                $formatString = $column->asXML();
                $formatString = str_replace($replaceArray,"",$formatString);
                $newRow['td'][] = $formatString;
            }
            foreach ($row->th as $column){
                $formatString = $column->asXML();
                $formatString = str_replace($replaceArray,"",$formatString);
                $newRow['td'][] = $formatString;
            }
            $rowArray[] = $newRow;
        }
        return $rowArray;
    }
    public function prepareTable(\SimpleXMLElement $table, string $author='ProNobis',string $official='false',string $legal=null){
        $new = new IncarnateTable();
        $new->setAuthor($author);
        if ($table->chapterTableDescription){
            $description = $this->formatParagraphs($table->chapterTableDescription);
            $new->setDescription($description);
        }
        $new->setFid($table['FID']);
        if ($legal){
            $legal = $this->formatParagraphs($legal);
            $new->setLegal($legal);
        }
        $new->setName($table->title);
        $new->setOfficial($official);
        $new->setType('rollableTable');
        $new->setUgfid($table['tableID']);
        if ($table->chapterTableColumnTitles){
            $columnNameArray = array();
            foreach ($table->chapterTableColumnTitles->children() as $columnName){
                $columnNameArray[] = $columnName->__toString();
            }
            $new->setColumnNames($columnNameArray);
        }
        if($table->diceModifier && $table->diceModifier != '0'){
            $new->setDicemodifier(intval($table->diceModifier));
        }
        if($table->diceToRoll && $table->diceToRoll != ''){
            $new->setDicetoroll($table->diceToRoll);
        }
        $tr = $this->prepareTableRows($table);
        $new->setTr($tr);
        $this->em->persist($new);
        return true;
    }
    public function importTables(){
        $repository = $this->em->getRepository(IncarnateTable::class);
        $repository->deleteAll()->getQuery()->execute();
        $backgrounds = $this->ugf->chapters->backgroundChapter->backgrounds;
        foreach ($backgrounds->children() as $background){
            $this->prepareTable($background->backgroundSuggestedCharacteristics->backgroundPersonality);
            $this->prepareTable($background->backgroundSuggestedCharacteristics->backgroundIdeal);
            $this->prepareTable($background->backgroundSuggestedCharacteristics->backgroundBond);
            $this->prepareTable($background->backgroundSuggestedCharacteristics->backgroundFlaw);
            foreach ($background->backgroundSuggestedCharacteristics->backgroundMiscellaneous as $miscTable){
                $this->prepareTable($miscTable);
            }
        }
        $races = $this->ugf->chapters->racesChapter->races;
        foreach ($races->children() as $race){
            if($race->raceSuggestedCharacteristics->racePersonality){
                $this->prepareTable($race->raceSuggestedCharacteristics->racePersonality);
            }
            if($race->raceSuggestedCharacteristics->raceBond){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceBond);
            }
            if($race->raceSuggestedCharacteristics->raceIdeal){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceIdeal);
            }
            if($race->raceSuggestedCharacteristics->raceFlaw){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceFlaw);
            }
            if($race->raceSuggestedCharacteristics->raceDescriptionFemale){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceDescriptionFemale);
            }
            if($race->raceSuggestedCharacteristics->raceDescriptionMale){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceDescriptionMale);
            }
            if($race->raceSuggestedCharacteristics->raceImageFemale){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceImageFemale);
            }
            if($race->raceSuggestedCharacteristics->raceImageMale){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceImageMale);
            }
            if($race->raceSuggestedCharacteristics->raceNameClan){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceNameClan);
            }
            if($race->raceSuggestedCharacteristics->raceNameFemale){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceNameFemale);
            }
            if($race->raceSuggestedCharacteristics->raceNameMale){
                $this->prepareTable($race->raceSuggestedCharacteristics->raceNameMale);
            }
            if($race->subraces){
                foreach ($race->subraces->children() as $subrace){
                    if($subrace->subraceSuggestedCharactersitics->raceDescriptionFemale){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceDescriptionFemale);
                    }
                    if($subrace->subraceSuggestedCharactersitics->raceDescriptionMale){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceDescriptionMale);
                    }
                    if($subrace->subraceSuggestedCharactersitics->raceImageFemale){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceImageFemale);
                    }
                    if($subrace->subraceSuggestedCharactersitics->raceImageMale){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceImageMale);
                    }
                    if($subrace->subraceSuggestedCharactersitics->raceNameClan){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceNameClan);
                    }
                    if($subrace->subraceSuggestedCharactersitics->raceNameFemale){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceNameFemale);
                    }
                    if($subrace->subraceSuggestedCharactersitics->raceNameMale){
                        $this->prepareTable($race->raceSuggestedCharacteristics->raceNameMale);
                    }
                }
            }
        }
        $tables = $this->ugf->chapters->tables;
        foreach ($tables->tableChapter as $chapter){
            foreach ($chapter->chapterTables->chapterTable as $rollableTable){
                $this->prepareTable($rollableTable);
            }
        }
        $this->em->flush();
        return true;
    }
    public function assembleSections(\SimpleXMLElement $sec1,string $top='top'):string {
        $result = '<h1 id="' . $sec1['FID'] . '">' . $this->heading1($sec1->heading1,$top) . '</h1>';
        if(count($sec1->section2)>1){
            foreach ($sec1->section2 as $sec2) {
                $result.='<p>'.$this->heading2($sec2->heading2,$sec2['FID']).'</p>';
            }
        }
        foreach($sec1->paragraph as $par){
            $result.=$this->formatParagraphs($par);
        }
        foreach($sec1->section2 as $sec2){
            $result .= '<h2 id="'.$sec2['FID'].'">'.$this->heading2($sec2->heading2,$sec1['FID']).'</h2>';
            if(count($sec2->section3)>1){
                foreach ($sec2->section3 as $sec3){
                    $result.='<p>'.$this->heading3($sec3->heading3,$sec3['FID']).'</p>';
                }
            }
            foreach($sec2->paragraph as $par){
                $result.=$this->formatParagraphs($par);
            }
            foreach ($sec2->section3 as $sec3){
                $result.='<h3 id="'.$sec3['FID'].'">'.$this->heading3($sec3->heading3,$sec2['FID']).'</h3>';
                if(count($sec3->section4)>1){
                    foreach ($sec3->section4 as $sec4){
                        $result.='<p>'.$this->heading4($sec4->heading4,$sec4['FID']).'</p>';
                    }
                }
                foreach($sec3->paragraph as $par){
                    $result.=$this->formatParagraphs($par);
                }
                foreach ($sec3->section4 as $sec4){
                    $result.='<h4 id="'.$sec4['FID'].'">'.$this->heading4($sec4->heading4,$sec3['FID']).'</h4>';
                    if(count($sec4->section5)>1){
                        foreach ($sec4->section5 as $sec5){
                            $result.='<p>'.$this->heading5($sec5->heading5,$sec5['FID']).'</p>';
                        }
                    }
                    foreach($sec4->paragraph as $par){
                        $result.=$this->formatParagraphs($par);
                    }
                    foreach ($sec4->section5 as $sec5){
                        $result.='<h5 id="'.$sec5['FID'].'">'.$this->heading5($sec5->heading5,$sec5['FID']).'</h5>';
                        if(count($sec5->section6)>1){
                            foreach ($sec5->section6 as $sec6){
                                $result.='<p>'.$this->heading6($sec6->heading6,$sec6['FID']).'</p>';
                            }
                        }
                        foreach($sec5->paragraph as $par){
                            $result.=$this->formatParagraphs($par);
                        }
                        foreach ($sec5->section6 as $sec6){
                            $result.='<h6 id="'.$sec6['FID'].'">'.$this->heading6($sec6->heading6,$sec6['FID']).'</h6>';
                            foreach($sec6->paragraph as $par){
                                $result.=$this->formatParagraphs($par);
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }
    public function prepareChapterIntro(\SimpleXMLElement $chapter, string $category = null){
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
            $new = new ChapterIntro();
            $new->setAuthor('ProNobis');
            $sections = $this->assembleSections($sec1,$top);
            if($category) {
                $new->setCategory($category);
            }
            $new->setDescription($sections);
            $new->setName($this->headingText(str_replace(['<heading1>', '</heading1>'], '', $sec1->heading1->asXML())));
            $new->setFid($sec1['FID']);
            if ($chapter->officialContent) {
                $new->setOfficial($chapter->officialContent);
            }else{
                $new->setOfficial(false);
            }
            if ($sec1['simpleName']) {
                $new->setSimpleName($sec1['simpleName']);
            }
            if ($sec1['template']) {
                $new->setTemplate(boolval($sec1['template']));
            }else{
                $new->setTemplate(false);
            }
            $new->setType('chapterIntro');
            $new->setUgfid($sec1['secID']);
            $this->em->persist($new);
        }
        return true;
    }
    public function importChapterIntros(){
        $repository = $this->em->getRepository(ChapterIntro::class);
        $repository->deleteAll()->getQuery()->execute();
        $this->prepareChapterIntro($this->ugf->chapters->GMsBlind,'GMs Screen');
        $this->prepareChapterIntro($this->ugf->chapters->PlayerQuickSheet,'Player Quick Sheet');
        $this->prepareChapterIntro($this->ugf->chapters->backgroundChapter->backgroundsIntroduction,'Background Intro');
        $this->prepareChapterIntro($this->ugf->chapters->classChapter->classIntroduction,'Class Intro');
        $this->prepareChapterIntro($this->ugf->chapters->featChapter->featIntroduction,'Feat Intro');
        $this->prepareChapterIntro($this->ugf->chapters->itemChapter->itemsIntroduction,'Equipment Intro');
        $this->prepareChapterIntro($this->ugf->chapters->magicitemTemplatesChapter->magicItemTemplatesIntroduction,'Magical Properties Intro');
        $this->prepareChapterIntro($this->ugf->chapters->npcChapter->npcsIntroduction,'NPC Intro');
        $this->prepareChapterIntro($this->ugf->chapters->planeChapter->planesIntroduction,'Lore Intro');
        $this->prepareChapterIntro($this->ugf->chapters->racesChapter->racesIntroduction,'Race Intro');
        $this->prepareChapterIntro($this->ugf->chapters->riddlesChapter->riddlesIntroduction,'Riddle Intro');
        $this->prepareChapterIntro($this->ugf->chapters->skillsChapter->skillsIntroduction,'Skill Intro');
        $this->prepareChapterIntro($this->ugf->chapters->spellsChapter->spellsIntroduction,'Spell Intro');
        foreach($this->ugf->chapters->miscellaneousChapters->miscellaneousChapter as $chapter){
            $this->prepareChapterIntro($chapter,$chapter->chapterName->__toString());
        }
        $this->em->flush();
        return true;
    }
    public function importClasses(){
        $repository = $this->em->getRepository(IncarnateTable::class);
    }
}