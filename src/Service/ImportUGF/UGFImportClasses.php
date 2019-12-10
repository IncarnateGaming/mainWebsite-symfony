<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateClass;
use App\Entity\IncarnateClassArchetype;
use App\Entity\IncarnateClassArchetypeTrait;
use App\Entity\IncarnateClassTrait;

class UGFImportClasses extends BaseUGFImporter
{
    //Takes either (\SimpleXMLElement $trait, IncarnateClassTrait $new, IncarnateClass $parent)
    //or (\SimpleXMLElement $trait, IncarnateClassArchetypeTrait $new, IncarnateClassArchetype $parent)
    public function classTraitSharedParts(\SimpleXMLElement $trait,$new,$parent):bool{
        $new->setAuthor($parent->getAuthor());
        $new->setDescription($this->functions->formatParagraphs($trait->classTraitDescription));
        $new->setFid($trait['FID']);
        $new->setLegal($parent->getLegal());
        $new->setLevel(intval($trait->classTraitLevel));
        $new->setName($trait->classTraitName);
        $new->setOfficial($parent->getOfficial());
        return true;
    }
    public function assembleArchetypeTraits(\SimpleXMLElement $traits,IncarnateClassArchetype $parent):bool{
        foreach ($traits as $trait){
            $new = new IncarnateClassArchetypeTrait();
            $new->setType($this->incImportType['classArchetypeTrait']);
            $new->setUgfid($trait['classArchtypeTraitID']);
            $new->setIncarnateClassArchetype($parent);
            $this->classTraitSharedParts($trait,$new,$parent);
            $this->em->persist($new);
        }
        return true;
    }
    public function  assembleClassTraits(\SimpleXMLElement $traits,IncarnateClass $parent):bool{
        foreach ($traits as $trait){
            $new = new IncarnateClassTrait();
            $new->setType($this->incImportType['classTrait']);
            $new->setUgfid($trait['classTraitID']);
            $new->setIncarnateClass($parent);
            //TODO get specialization choice working
            if($trait->classSpecializationChoice && 'true'==$trait->classSpecializationChoice->__toString()){
                $new->setSpecializationChoice(1);
            }
            else{
                $new->setSpecializationChoice(0);
            }
            $this->classTraitSharedParts($trait,$new,$parent);
            $this->em->persist($new);
        }
        return true;
    }
    public function assembleArchetypes(\SimpleXMLElement $archetypes,IncarnateClass $class):bool {
        foreach ($archetypes as $archetype){
            $new = new IncarnateClassArchetype();
            $new->setAuthor($archetype->author);
            $new->setDescription($this->functions->formatParagraphs($archetype->classArchetypeDescription));
//            $new->setEquipment();
            $new->setFid($archetype['FID']);
            if($archetype->classArchetypeLegal){
                $legal = $this->functions->formatParagraphs($archetype->classArchetypeLegal);
            }else{
                $legal=$class->getLegal();
            }
            $new->setLegal($legal);
            $new->setName($archetype->classArchetypeName);
            $new->setOfficial($archetype->officialContent);
            $new->setType($this->incImportType['classArchetype']);
            $new->setUgfid($archetype['classArchtypeID']);
            $new->setIncarnateClass($class);
            $this->assembleArchetypeTraits($archetype->classArchetypeTraits->classArchetypeTrait,$new,$legal);
            $this->em->persist($new);
        }
        return true;
    }
    public function import(){
        $classArchetypeTraitRepository = $this->em->getRepository(IncarnateClassArchetypeTrait::class);
        $classArchetypeTraitRepository->deleteAll()->getQuery()->execute();
        $classArchetypeRepository = $this->em->getRepository(IncarnateClassArchetype::class);
        $classArchetypeRepository->deleteAll()->getQuery()->execute();
        $classTraitRepository = $this->em->getRepository(IncarnateClassTrait::class);
        $classTraitRepository->deleteAll()->getQuery()->execute();
        $classRepository = $this->em->getRepository(IncarnateClass::class);
        $classRepository->deleteAll()->getQuery()->execute();
        $ugfClasses = $this->ugf->chapters->classChapter->classes->class;
        foreach ($ugfClasses as $class){
            $new = new IncarnateClass();
            $archetypeInfo = array(
                'description'=>$this->functions->formatParagraphs($class->classArchetypes->archetypeDescription),
                'namePlural'=>$class->classArchetypes->archetypeName['plural']->__toString(),
            );
            $new->setArchetypeInfo($archetypeInfo);
            $new->setAuthor($class->author);
            if($class->classAmmendments) {
                $new->setClassAmmendment($this->functions->formatParagraphs($class->classAmmendments));
            }
            if($class->darkvision) {
                $new->setDarkvision($class->darkvision);
            }
            $new->setDescription($this->functions->formatParagraphs($class->classDescription));
            $equipment=array(
                'description'=>'',
            );
            foreach ($class->classEquipment->options->optionDescription as $option){
                $equipment['description'].='<li>'.$this->functions->headingText(str_replace(['<optionDescription>','</optionDescription>'],'',$option->asXML())).'</li>';
            }
            $new->setEquipment($equipment);
            $new->setFid($class['FID']);
            $hitPoints=array(
                'hitDice'=>$class->classHitPoints->hitDice->__toString(),
                'hitPointsAt1stLevel'=>$class->classHitPoints->hitPointsAt1stlevel->__toString(),
                'hitPointsAtHigherLevels'=>$class->classHitPoints->hitPointsAtHigherLevels->__toString(),
                'dieSize'=>$class->classHitPoints->dieSize->__toString(),
            );
            $new->setHitpoints($hitPoints);
            $legal = null;
            if($class->classLegal) {
                $legal = $this->functions->formatParagraphs($class->classLegal);
            }
            $new->setLegal($legal);
            $multiclass=array();
            if($class->classMulticlassProficiencies){
                if($class->classMulticlassProficiencies->armor){
                    $multiclass['armor']=$class->classMulticlassProficiencies->armor->__toString();
                }
                if($class->classMulticlassProficiencies->weapons){
                    $multiclass['weapons']=$class->classMulticlassProficiencies->weapons->__toString();
                }
                if($class->classMulticlassProficiencies->tools){
                    $multiclass['tools']=$class->classMulticlassProficiencies->tools->__toString();
                }
                if($class->classMulticlassProficiencies->skills){
                    $multiclass['skills']=$this->functions->headingText(str_replace(['<skills>','</skills>'],'',$class->classMulticlassProficiencies->skills->asXML()));
                }
            }
            $new->setLeveltable($this->functions->formatParagraphs($class->classTable));
            $new->setMulticlass($multiclass);
            $new->setName($class->className->__toString());
            $new->setOfficial($class->officialContent->__toString());
            $proficiencies=array(
                'armor'=>$class->classProficiencies->armor->__toString(),
                'weapons'=>$class->classProficiencies->weapons->__toString(),
                'tools'=>$class->classProficiencies->tools->__toString(),
                'savingThrows'=>$class->classProficiencies->savingThrows->__toString(),
                'skills'=>$this->functions->headingText(str_replace(['<choiceDescription>','</choiceDescription>'],'',$class->classProficiencies->skills->choiceDescription->asXML())),
            );
            $new->setProficiencies($proficiencies);
            $new->setType($this->incImportType['class']);
            $new->setUgfid($class['classID']);
            $this->assembleArchetypes($class->classArchetypes->classArchetype,$new);
            $this->assembleClassTraits($class->classTraits->classTrait,$new);
            $this->em->persist($new);
        }
        $this->em->flush();
        return true;
    }
}