<?php


namespace App\Service\ImportUGF;


use Doctrine\ORM\EntityManagerInterface;

class BaseUGFImporter
{

    public function __construct(EntityManagerInterface $em,UGFImportFunctions $functions)
    {
        $this->em = $em;
        $this->ugfFilePath = '../lib/xml/Incarnate-System.xml';
        $this->ugf = simplexml_load_file($this->ugfFilePath);
        $this->functions = $functions;
        $this->incImportType = array(
            'background'=>'back',
            'backgroundFeature'=>'backF',
            'class'=>'class',
            'classTrait'=>'classTr',
            'classArchetype'=>'classAr',
            'classArchetypeTrait'=>'classArTr',
            'equipment'=>'eq',
            'weapon'=>'eqWe',
            'armor'=>'armor',
            'feat'=>'feat',
            'magicProperty'=>'magicP',
            'npc'=>'npc',
            'race'=>'race',
            'raceTrait'=>'raceTr',
            'raceSubrace'=>'raceSub',
            'raceSubraceTrait'=>'raceSubTr',
            'riddle'=>'riddle',
            'rule'=>'rule',
            'skill'=>'skill',
            'spell'=>'spell',
            'table'=>'table',
            'template'=>'template',
            'chapter'=>'chap',
            'section1'=>'sec1',
            'section2'=>'sec2',
            'section3'=>'sec3',
            'section4'=>'sec4',
            'section5'=>'sec5',
            'section6'=>'sec6',
        );
    }
}