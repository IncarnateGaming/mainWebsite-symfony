<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateEquipment;

class UGFImportEquipment extends BaseUGFImporter
{
    public function higherLevelDamageXMLFormat(\SimpleXMLElement $higherLevels):array {
        $higherLevelArray=array(
            'type'=>$higherLevels->higherType->__toString(),
            'formula'=>$higherLevels->higherFormula->__toString(),
        );
        if($higherLevels->higherAbility){
            $higherLevelArray['ability']=$higherLevels->higherAbility->__toString();
        }
        if($higherLevels->higherModifier){
            $higherLevelArray['modifier']=intval($higherLevels->higherModifier->__toString());
        }
        return $higherLevelArray;
    }
    public function damagesXMLFormat(\SimpleXMLElement $damagesXML):array {
        $result = array();
        foreach ($damagesXML->damage as $damage){
            $newDamage = array();
            if($damage->ability){
                $newDamage['ability']=$damage->ability->__toString();
            }
            if($damage->criticalDice){
                $newDamage['criticalDice']=intval($damage->criticalDice->__toString());
            }
            if($damage->formula){
                $newDamage['formula']=$damage->formula->__toString();
            }
            if($damage->damageMaterial){
                $newDamage['material']=$damage->damageMaterial->__toString();
            }
            if($damage->damageType){
                $newDamage['type']=$damage->damageType->__toString();
            }
            if($damage->higherLevelDamage){
                $newDamage['higherLevels']=$this->higherLevelDamageXMLFormat($damage->higherLevelDamage);
            }
            if($damage->modifier){
                $newDamage['modifier']=intval($damage->modifier->__toString());
            }
            if($damage->proficiency){
                $newDamage['proficiency']=$damage->proficiency->__toString() === 'true' ? true : false;
            }
            $result[]=$newDamage;
        }
        return  $result;
    }
    public function import(){
        $equipmentRepository = $this->em->getRepository(IncarnateEquipment::class);
        $equipmentRepository->deleteAll()->getQuery()->execute();
        foreach ($this->ugf->chapters->itemChapter->items->item as $item){
            $new = new IncarnateEquipment();
            $ac = array(
                'ac'=>intval($item->itemArmorClass->__toString()),
            );
            if($item->itemArmorClass['dexterityModifier']){
                $ac['mod']=$item->itemArmorClass['dexterityModifier']->__toString();
            }else{
                $ac['mod']=false;
            }
            $new->setAc($ac);
            $new->setAuthor($item->author->__toString());
            if($item->itemCapacityCarrying) {
                $new->setCarryingcapacity($item->itemCapacityCarrying);
            }
            if($item->itemConsumable) {
                $new->setConsumable($item->itemConsumable->__toString()==='true'?true:false);
            }
            $new->setCost($item->itemCost->__toString());
            $new->setCostSortable(floatval($item->itemCostSortable->__toString()));
            $damages = array();
            if($item->VTTcode->UGFStandard->damages){
                foreach ($item->VTTcode->UGFStandard->damages as $damagesXML){
                    $damages[]=$this->damagesXMLFormat($damagesXML);
                }
            }
            $new->setDamage($damages);
            if($item->itemDescription){
                $new->setDescription($this->functions->formatParagraphs($item->itemDescription));
            }
            $new->setEquipmentType($item->itemType->__toString());
            $new->setFid($item['FID']->__toString());
            $new->setGmonly($item->GMOnly->__toString() === 'true' ? true : false);
            if($item->itemCapacityHolding){
                $new->setHoldingcapacity($item->itemCapacityHolding);
            }
            if($item->itemRange){
                $new->setItemrange($item->itemRange);
            }
//            TODO Add support for legal if we ever add items that require legal notes
//            $new->setLegal();
            $new->setMagical($item->includeItemInMagicLists->__toString() === 'true' ? true : false);
            $new->setMundane($item->includeItemInMundaneLists->__toString() === 'true' ? true : false);
            $new->setName($item->itemName->__toString());
            if($item->itemOffenseBonus){
                $new->setOffensebonus(intval($item->itemOffenseBonus));
            }
            $new->setOfficial($item->officialContent->__toString());
            if($item->itemProperties){
                $new->setProperties($this->functions->headingText(str_replace(['<itemProperties>','</itemProperties>'],'',$item->itemProperties->asXML())));
            }
            if($item->itemRarity){
                $rarity = array(
                    'level'=>$item->itemRarity->__toString(),
                );
                if($item->itemRarity['attunement']){
                    $rarity['attunement']=$item->itemRarity['attunement']->__toString();
                }
                if($item->itemRarity['preReq']){
                    $rarity['preReq']=$item->itemRarity['preReq']->__toString();
                }
                $new->setRarity($rarity);
            }
            if($item->itemRecommendedLevel){
                $new->setRecommendedlevel(intval($item->itemRecommendedLevel->__toString()));
            }
            if($item->itemSpeed){
                $new->setSpeed($item->itemSpeed);
            }
            if($item->itemStealth){
                $new->setStealth($item->itemStealth);
            }
            if($item->itemStrength){
                $new->setStrengthrequirement(intval($item->itemStrength->__toString()));
            }
            if($item->itemTypeSubtype){
                $new->setSubtype($item->itemTypeSubtype);
            }
            $new->setType($this->incImportType['equipment']);
            $new->setUgfid($item['itemID']->__toString());
            if($item->itemWeight){
                $new->setWeight(floatval($item->itemWeight->__toString()));
            }
            $this->em->persist($new);
        }
        $this->em->flush();
    }
}