<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;
use App\Entity\IncarnateClass;
use App\Entity\IncarnateClassArchetype;
use App\Entity\IncarnateClassArchetypeTrait;
use App\Entity\IncarnateClassTrait;
use App\Entity\IncarnateEquipment;
use App\Entity\IncarnateRace;
use App\Entity\IncarnateRaceSubrace;
use App\Entity\IncarnateRaceSubraceTrait;
use App\Entity\IncarnateRaceTrait;
use App\Entity\IncarnateTable;

class UGFImportStart extends BaseUGFImporter
{
    public function purge(){
        $this->em->getRepository(IncarnateRaceSubraceTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateRaceSubrace::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateRaceTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateRace::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateEquipment::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateBackgroundFeature::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateBackground::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClassArchetypeTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClassArchetype::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClassTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClass::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateTable::class)->deleteAll()->getQuery()->execute();
    }
}