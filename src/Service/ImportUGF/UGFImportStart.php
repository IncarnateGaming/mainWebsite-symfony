<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateBackground;
use App\Entity\IncarnateBackgroundFeature;
use App\Entity\IncarnateClass;
use App\Entity\IncarnateClassArchetype;
use App\Entity\IncarnateClassArchetypeTrait;
use App\Entity\IncarnateClassTrait;
use App\Entity\IncarnateEquipment;
use App\Entity\IncarnateFeat;
use App\Entity\IncarnateLoreBuildings;
use App\Entity\IncarnateLoreCitizen;
use App\Entity\IncarnateLoreCity;
use App\Entity\IncarnateLoreCountry;
use App\Entity\IncarnateLoreDistrict;
use App\Entity\IncarnateLorePlane;
use App\Entity\IncarnateLorePlanet;
use App\Entity\IncarnateLorePointOfInterest;
use App\Entity\IncarnateLoreState;
use App\Entity\IncarnateLoreSubpoint;
use App\Entity\IncarnateRace;
use App\Entity\IncarnateRaceSubrace;
use App\Entity\IncarnateRaceSubraceTrait;
use App\Entity\IncarnateRaceTrait;
use App\Entity\IncarnateTable;

class UGFImportStart extends BaseUGFImporter
{
    public function purge(){
//        Final Elements dependent on general content (must be deleted first)
        $this->em->getRepository(IncarnateLoreCitizen::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLoreSubpoint::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLorePointOfInterest::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLoreBuildings::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLoreDistrict::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLoreCity::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLoreState::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLoreCountry::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLorePlanet::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateLorePlane::class)->deleteAll()->getQuery()->execute();

//        Content based elements (must be deleted after general content)
        $this->em->getRepository(IncarnateRaceSubraceTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateRaceSubrace::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateRaceTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateRace::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateFeat::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateEquipment::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateBackgroundFeature::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateBackground::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClassArchetypeTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClassArchetype::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClassTrait::class)->deleteAll()->getQuery()->execute();
        $this->em->getRepository(IncarnateClass::class)->deleteAll()->getQuery()->execute();

//        Foundational Elements (must be deleted last as they have many many dependencies)
        $this->em->getRepository(IncarnateTable::class)->deleteAll()->getQuery()->execute();
    }
}