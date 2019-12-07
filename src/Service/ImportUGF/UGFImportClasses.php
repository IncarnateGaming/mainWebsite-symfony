<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateClass;

class UGFImportClasses extends BaseUGFImporter
{
    public function assembleTraits(\SimpleXMLElement $traits):array{
        $result = array();
        foreach ($traits as $trait){
            $traitArray = array(
                'description'=>$this->functions->formatParagraphs($trait->classTraitDescription),
                'fid'=>$trait['FID'],
                'level'=>intval($trait->classTraitLevel),
                'name'=>$trait->classTraitName,
                'ugfid'=>$trait['classArchtypeTraitID'],
            );
            $result[]=$traitArray;
        }
        return $result;
    }
    public function assembleArchetypes(\SimpleXMLElement $archetypes):array{
        $result = array();
        foreach ($archetypes as $archetype){
            $archetypeArray = array(
                'description'=>$this->functions->formatParagraphs($archetype->classArchetypeDescription),
                'fid'=>$archetype['FID'],
                'legal'=>null,
                'name'=>$archetype->classArchetypeName,
                'traits'=>$this->assembleTraits($archetype->classArchetypeTraits->classarchetypeTrait),
                'official'=>$archetype->officialContent,
                'ugfid'=>$archetype['classArchtypeID'],
            );
            if($archetype->classArchetypeLegal){
                $archetypeArray['legal']=$this->functions->formatParagraphs($archetype->classArchetypeLegal);
            }
            $result[]=$archetypeArray;
        }
        return result;
    }
    public function importClasses(){
        $ugfClasses = $this->ugf->chapters->classChapter->classes->class;
        foreach ($ugfClasses as $class){
            $new = new IncarnateClass();
            $new->setArchetype($class->classArchetypes->classArchetype);
            $new->setAuthor();
            $new->setClassAmmendment();
            $new->setDarkvision();
            $new->setDescription();
            $new->setEquipment();
            $new->setFid();
            $new->setHitpoints();
            $new->setLegal();
            $new->setMulticlass();
            $new->setName();
            $new->setOfficial();
            $new->setProficiencies();
            $new->setTrait();
            $new->setType();
            $new->setUgfid();
            $this->em->persist($new);
        }
        $this->em->flush();
        return true;
    }
}