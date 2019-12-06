<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;

class UGFImportBackgrounds extends BaseUGFImporter
{
    public function importBackgrounds(){
        $backgrounds = $this->ugf->chapters->backgroundChapter->backgrounds;
        $repository = $this->em->getRepository(IncarnateBackground::class);
        $repository->deleteAll()->getQuery()->execute();
        foreach ($backgrounds->children() as $background){
            $back = new IncarnateBackground();
            $back->setAuthor($background->backgroundAuthor);
            $back->setBondfid($background->backgroundSuggestedCharacteristics->backgroundBond['FID']);
            $description = $this->functions->formatParagraphs($background->backgroundDescription);
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
                $legal = $this->functions->formatParagraphs($background->backgroundLegal);
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
                'description'=>$this->functions->richText($background->backgroundStartingEquipment->description),
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
            $suggestedChar = $this->functions->formatParagraphs($background->backgroundSuggestedCharacteristics->backgroundCharacteristicsDescription);
            $back->setSuggestedCharIntro($suggestedChar);
            if ($background->backgroundToolProficiencies){
                $toolArray = array(
                    'description'=> '<p>' . $this->functions->richText($background->backgroundToolProficiencies->description) . '</p>',
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
            $description = $this->functions->formatParagraphs($background->backgroundFeature->backgroundFeatureDescription);
            $backFeat->setDescription($description);
            $backFeat->setFid($background->backgroundFeature['FID']);
            if ($background->backgroundLegal){
                $legal = $this->functions->formatParagraphs($background->backgroundLegal);
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
}