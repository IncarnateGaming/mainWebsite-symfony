<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateEquipment;

class UGFImportEquipment extends BaseUGFImporter
{
    public function import(){
        $equipmentRepository = $this->em->getRepository(IncarnateEquipment::class);
        $equipmentRepository->deleteAll()->getQuery()->execute();
        foreach ($this->ugf->chapters->itemChapter->items->item as $item){
            $new = new IncarnateEquipment();
            $ac = array(
                'ac'=>$item->itemArmorClass->asXML(),
                'mod'=>$item->itemArmorClass['dexterityModifier'],
            );
            $new->setAc($ac);
            $author = $item->officialContent->__toString() === 'true' ? true : false;
            $new->setAuthor($author);
            $new->setCarryingcapacity();
            $new->setConsumable();
            $new->setCost();
            $new->setCostSortable();
            $new->setDamage();
            $new->setDescription();
            $new->setEquipmentType();
            $new->setFid();
            $new->setGmonly();
            $new->setHoldingcapacity();
            $new->setItemrange();
            $new->setLegal();
            $new->setMagical();
            $new->setMundane();
            $new->setName();
            $new->setOffensebonus();
            $new->setOfficial();
            $new->setProperties();
            $new->setRarity();
            $new->setRecommendedlevel();
            $new->setSpeed();
            $new->setStealth();
            $new->setStrengthrequirement();
            $new->setSubtype();
            $new->setType();
            $new->setUgfid();
            $new->setWeight();
            dump($new);die;
        }
    }
}