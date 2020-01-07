<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateTable;

class UGFImportRollableTables extends BaseUGFImporter
{
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
                $newRow['td'][] = $this->functions->formatParagraphs($column);
//                $formatString = $column->asXML();
//                $formatString = str_replace($replaceArray,"",$formatString);
//                $newRow['td'][] = $formatString;
            }
            foreach ($row->th as $column){
                $newRow['td'][] = $this->functions->formatParagraphs($column);
//                $formatString = $column->asXML();
//                $formatString = str_replace($replaceArray,"",$formatString);
//                $newRow['td'][] = $formatString;
            }
            $rowArray[] = $newRow;
        }
        return $rowArray;
    }
    public function prepareTable(\SimpleXMLElement $table, string $author='ProNobis',string $official='false',string $legal=null){
        $new = $this->em->getRepository(IncarnateTable::class)->findOneBy(['fid'=>$table['FID']]);
        if(!$new){
            $new = new IncarnateTable();
        }
        $new->setAuthor($author);
        if ($table->chapterTableDescription){
            $description = $this->functions->formatParagraphs($table->chapterTableDescription);
            $new->setDescription($description);
        }
        $new->setFid($table['FID']);
        if ($legal){
            $legal = $this->functions->formatParagraphs($legal);
            $new->setLegal($legal);
        }
        $new->setName($table->title);
        $new->setOfficial($official);
        $new->setType($this->incImportType['table']);
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
    public function import(){
        $repository = $this->em->getRepository(IncarnateTable::class);
//        $repository->deleteAll()->getQuery()->execute();
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
}