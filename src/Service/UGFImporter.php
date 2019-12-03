<?php


namespace App\Service;


use App\Entity\IncarnateBackground;


class UGFImporter
{
    public function getUGF($ugfFilePath = '../lib/xml/Incarnate-System.xml'){
        $ugf = simplexml_load_file($ugfFilePath);
        return $ugf;
    }
    public function richText($string):string{
        $result = $string;
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
    public function formatParagraphs($xml):string {
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
    public function importBackgrounds($ugfFilePath = '../lib/xml/Incarnate-System.xml'){
        $ugf = $this->getUGF($ugfFilePath);
        $backgrounds = $ugf->chapters->backgroundChapter->backgrounds;
        foreach ($backgrounds->children() as $background){
            $back = new IncarnateBackground();
            $back->setAuthor($background->backgroundAuthor);
            $back->setBondFID($background->backgroundSuggestedCharacteristics->backgroundBond['FID']);
            $description = $this->formatParagraphs($background->backgroundDescription);
            $back->setDescription($description);
            $back->setFeatureFid($background->backgroundFeature['FID']);
            $back->setFID($background['FID']);
            $back->setFlawFID($background->backgroundSuggestedCharacteristics->backgroundFlaw['FID']);
            $back->setGp(intval($background->backgroundGP));
            $back->setIdealFID($background->backgroundSuggestedCharacteristics->backgroundIdeal['FID']);
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
            $back->setPersonalityFID($background->backgroundSuggestedCharacteristics->backgroundPersonality['FID']);
            $skillProficiencies = $background->backgroundSkillProficiencies->description->children();
            $skillProfRes = array();
            foreach ($skillProficiencies as $skillProficiency){
                $skillArray = array(
                    'skill' => $skillProficiency->__toString(),
                    'fid' => $skillProficiency['FID'],
                );
                $skillProfRes[] = $skillArray;
            }
            $back->setSkillProficiencies($skillProfRes);
            $startingEquipRes = array(
                'itemArray'=>array(),
                'description'=>'<p>' . $this->richText($background->backgroundStartingEquipment->description) . '</p>',
            );
            $startEquipItems = $background->backgroundStartingEquipment->defaultChoices->children();
            foreach ($startEquipItems as $item){
                $itemFormat = array(
                    'name'=>$item->includedItemName,
                    'quantity'=>$item->includedItemQuantity,
                    'FID'=>$item['FID'],
                );
                $startingEquipRes['itemArray'][] = $itemFormat;
            }
            $back->setStartingEquipment($startingEquipRes);
            if ($background->backgroundToolProficiencies){
                $toolArray = array(
                    'description'=> '<p>' . $this->richText($background->backgroundToolProficiencies->description) . '</p>',
                    'tools'=> array(),
                );
                if ($background->backgroundToolProficiencies->description->crossReference){
                    foreach ($background->backgroundToolProficiencies->description->children() as $tool){
                        $toArray = array(
                            'name'=> $tool->__toString(),
                            'FID'=> $tool['FID'],
                        );
                        $toolArray['tools'][] = $toArray;
                    }
                }
                $back->setToolProficiencies($toolArray);
            }
            $back->setType('background');
            $back->setUgfid($background['backgroundID']);
            var_dump($back) ;
            die;
        }
    }
}