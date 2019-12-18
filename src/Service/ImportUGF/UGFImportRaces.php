<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateRace;
use App\Entity\IncarnateRaceSubrace;
use App\Entity\IncarnateRaceSubraceTrait;
use App\Entity\IncarnateRaceTrait;
use App\Entity\IncarnateTable;

class UGFImportRaces extends BaseUGFImporter
{
    public function import(){
        $subraceTraitRepository = $this->em->getRepository(IncarnateRaceSubraceTrait::class);
        $subraceTraitRepository->deleteAll()->getQuery()->execute();
        $subraceRepository = $this->em->getRepository(IncarnateRaceSubrace::class);
        $subraceRepository->deleteAll()->getQuery()->execute();
        $raceTraitRepository = $this->em->getRepository(IncarnateRaceTrait::class);
        $raceTraitRepository->deleteAll()->getQuery()->execute();
        $raceRepository = $this->em->getRepository(IncarnateRace::class);
        $raceRepository->deleteAll()->getQuery()->execute();
//        dump($this->incImportType);die;
        foreach ($this->ugf->chapters->racesChapter->races->race as $race) {
            $new = new IncarnateRace();
            $new->setAuthor($race->author->__toString());
            $new->setDarkvision(intval($race->raceTraits->darkvision->__toString()));
            $new->setDescription($this->functions->formatParagraphs($race->raceDescription));
            $new->setFid($race['FID']);
            $languages = array();
            foreach($race->raceLanguages->raceLanguage as $language){
                $languages[] = $language->__toString();
            }
            $new->setLanguages($languages);
            if($race->raceLegal){
                $new->setLegal($this->functions->formatParagraphs($race->raceLegal));
            }
            $new->setName($race->raceName->__toString());
            $new->setOfficial($race->officialContent->__toString());
//            $new->setSkills();
            if($race->statChanges){
                $this->setStatChange($race->statChanges->statChange,$new);
            }
            $new->setType($this->incImportType['race']);
            $new->setUgfid($race['raceID']);
            if($race->raceSuggestedCharacteristics->raceCharacteristicsDescription){
                $new->setCharateristicsDescription($this->functions->formatParagraphs($race->raceSuggestedCharacteristics->raceCharacteristicsDescription));
            }
            $tableRepository = $this->em->getRepository(IncarnateTable::class);
            if($race->raceSuggestedCharacteristics->racePersonality){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->racePersonality['FID']]);
                if($targetTable){
                    $new->setPersonality($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceIdeal){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceIdeal['FID']]);
                if($targetTable){
                    $new->setIdeal($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceBond){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceBond['FID']]);
                if($targetTable){
                    $new->setBond($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceFlaw){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceFlaw['FID']]);
                if($targetTable){
                    $new->setFlaw($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceDescriptionFemale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceDescriptionFemale['FID']]);
                if($targetTable){
                    $new->setDescriptionFemale($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceDescriptionMale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceDescriptionMale['FID']]);
                if($targetTable){
                    $new->setDescriptionMale($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceImageFemale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceImageFemale['FID']]);
                if($targetTable){
                    $new->setImageFemale($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceImageMale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceImageMale['FID']]);
                if($targetTable){
                    $new->setImageMale($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceNameClan){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceNameClan['FID']]);
                if($targetTable){
                    $new->setNameClan($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceNameFemale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceNameFemale['FID']]);
                if($targetTable){
                    $new->setNameFemale($targetTable);
                }
            }
            if($race->raceSuggestedCharacteristics->raceNameMale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$race->raceSuggestedCharacteristics->raceNameMale['FID']]);
                if($targetTable){
                    $new->setNameMale($targetTable);
                }
            }
            $this->assembleSubraces($race->subraces->subrace,$new);
            $this->assembleRaceTraits($race->raceTraits->raceTrait,$new);
//            dump($new);die;
            $this->em->persist($new);
        }
        $this->em->flush();
    }
    public function assembleRaceTraits(\SimpleXMLElement $traits, IncarnateRace $race)
    {
        forEach($traits as $trait){
            $new = new IncarnateRaceTrait();
            $new->setType($this->incImportType['raceTrait']);
            $new->setLegal($race->getLegal());
            $new->setDescription($this->functions->formatParagraphs($trait->raceTraitDescription));
            $new->setAuthor($race->getAuthor());
            $new->setName($trait->raceTraitName->__toString());
            $new->setFid($trait['FID']->__toString());
            $new->setUgfid($trait['raceTraitID']->__toString());
            $new->setOfficial($race->getOfficial());
            $new->setRace($race);
            $this->em->persist($new);
        }
        return true;
    }
    public function assembleSubraces(\SimpleXMLElement $subraces, IncarnateRace $race){
        forEach($subraces as $subrace) {
            $new = new IncarnateRaceSubrace();
            $new->setAuthor($subrace->author->__toString());
            $new->setDarkvision(intval($subrace->subraceTraits->darkvision->__toString())+$race->getDarkvision());
            $new->setDescription($this->functions->formatParagraphs($subrace->subraceDescription));
            $new->setFid($subrace['FID']->__toString());
            if($subrace->subraceLanguages){
                $languages = array();
                foreach ($subrace->subraceLanguages->subraceLanguage as $language) {
                    $languages[] = $language->__toString();
                }
                $new->setLanguages($languages);
            }
            if($subrace->subraceLegal){
                $new->setLegal($this->functions->formatParagraphs($subrace->subraceLegal));
            }elseif($race->getLegal()){
                $new->setLegal($race->getLegal());
            }
            $new->setName($subrace->subraceName->__toString());
            $new->setOfficial($subrace->officialContent->__toString());
            if($subrace->statChanges){
                $this->setStatChange($subrace->statChanges->statChange,$new);
            }
            $new->setType($this->incImportType['raceSubrace']);
            $new->setUgfid($subrace['subraceID']);
            $tableRepository = $this->em->getRepository(IncarnateTable::class);
            if($subrace->subraceSuggestedCharacteristics->raceDescriptionFemale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceDescriptionFemale['FID']]);
                if($targetTable){
                    $new->setDescriptionFemale($targetTable);
                }
            }
            if($subrace->subraceSuggestedCharacteristics->raceDescriptionMale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceDescriptionMale['FID']]);
                if($targetTable){
                    $new->setDescriptionMale($targetTable);
                }
            }
            if($subrace->subraceSuggestedCharacteristics->raceImageFemale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceImageFemale['FID']]);
                if($targetTable){
                    $new->setImageFemale($targetTable);
                }
            }
            if($subrace->subraceSuggestedCharacteristics->raceImageMale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceImageMale['FID']]);
                if($targetTable){
                    $new->setImageMale($targetTable);
                }
            }
            if($subrace->subraceSuggestedCharacteristics->raceNameClan){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceNameClan['FID']]);
                if($targetTable){
                    $new->setNameClan($targetTable);
                }
            }
            if($subrace->subraceSuggestedCharacteristics->raceNameFemale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceNameFemale['FID']]);
                if($targetTable){
                    $new->setNameFemale($targetTable);
                }
            }
            if($subrace->subraceSuggestedCharacteristics->raceNameMale){
                $targetTable = $tableRepository->findOneBy(['fid'=>$subrace->subraceSuggestedCharacteristics->raceNameMale['FID']]);
                if($targetTable){
                    $new->setNameMale($targetTable);
                }
            }
            $this->assembleSubraceTraits($subrace->subraceTraits->subraceTrait,$new);
            $new->setRace($race);
            $this->em->persist($new);
        }
        return true;
    }
    public function assembleSubraceTraits(\SimpleXMLElement $traits,IncarnateRaceSubrace $subrace){
        foreach ($traits as $trait){
            $new = new IncarnateRaceSubraceTrait();
            $new->setAuthor($subrace->getAuthor());
            $new->setDescription($this->functions->formatParagraphs($trait->subraceTraitDescription));
            $new->setFid($trait['FID']);
            $new->setLegal($subrace->getLegal());
            $new->setName($trait->subraceTraitName->__toString());
            $new->setOfficial($subrace->getOfficial());
            $new->setType($this->incImportType['raceSubraceTrait']);
            $new->setUgfid($trait['subraceTraitID']);
            $new->setSubrace($subrace);
            $this->em->persist($new);
        }
        return true;
    }
    public function setStatChange(\SimpleXMLElement $statChanges,$new){
        $changes = array();
        foreach ($statChanges as $change){
            $changes[]=array(
                'ability'=>$change->ability->__toString(),
                'change'=>$change->change->__toString(),
            );
        }
        $new->setStatChanges($changes);
    }
}