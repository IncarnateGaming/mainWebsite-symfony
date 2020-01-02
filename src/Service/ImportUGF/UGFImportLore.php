<?php


namespace App\Service\ImportUGF;


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

class UGFImportLore extends BaseUGFImporter
{
    public function import(){
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
        foreach ($this->ugf->chapters->planeChapter->planes->plane as $plane){
            $new = new IncarnateLorePlane();
            $new->setOfficial('false');
            $new->setAuthor($plane->author->__toString());
            $new->setUgfid($plane['UGF']);
            $new->setName($plane->name->__toString());
            $new->setDescription($this->functions->formatParagraphs($plane->description));
            $new->setFid($plane['FID']);
            $new->setType($this->incImportType['lorePlane']);
            if('' !== $plane->map->__toString()) {
                $new->setMap($plane->map->__toString());
            }
            $this->setupPlanets($new,$plane);
            if($plane->pointsOfInterest) {
                foreach ($plane->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                    $newPoi = $this->setupPOI($pointOfInterest);
                    $newPoi->setIncarnateLorePlane($new);
                    $this->em->persist($newPoi);
                }
            }
            $this->em->persist($new);
        }
        $this->em->flush();
    }
    public function setupPlanets(IncarnateLorePlane $incarnateLorePlane, \SimpleXMLElement $plane){
        if($plane->planets) {
            foreach ($plane->planets->planet as $planet) {
                $incarnateLorePlanet = new IncarnateLorePlanet();
                $incarnateLorePlanet->setAuthor($planet->author->__toString());
                $incarnateLorePlanet->setDescription($this->functions->formatParagraphs($planet->description));
                $incarnateLorePlanet->setFid($planet['FID']);
                $incarnateLorePlanet->setOfficial('false');
                $incarnateLorePlanet->setName($planet->name->__toString());
                if(''!==$planet->map->__toString()) {
                    $incarnateLorePlanet->setMap($planet->map->__toString());
                }
                $incarnateLorePlanet->setType($this->incImportType['lorePlanet']);
                $incarnateLorePlanet->setUgfid($planet['UGF']);
                $incarnateLorePlanet->setIncarnateLorePlane($incarnateLorePlane);
                $this->setupCountry($incarnateLorePlanet,$planet);
                if($planet->pointsOfInterest) {
                    foreach ($planet->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                        $newPoi = $this->setupPOI($pointOfInterest);
                        $newPoi->setIncarnateLorePlanet($incarnateLorePlanet);
                        $this->em->persist($newPoi);
                    }
                }
                $this->em->persist($incarnateLorePlanet);
            }
        }
    }
    public function setupCountry(IncarnateLorePlanet $incarnateLorePlanet, \SimpleXMLElement $planet){
        if($planet->countries){
            foreach ($planet->countries->country as $country){
                $incarnateLoreCountry = new IncarnateLoreCountry();
                $incarnateLoreCountry->setAuthor($country->author->__toString());
                $incarnateLoreCountry->setDescription($this->functions->formatParagraphs($country->description));
                $incarnateLoreCountry->setFid($country['FID']);
                $incarnateLoreCountry->setOfficial('false');
                $incarnateLoreCountry->setName($country->name->__toString());
                if(''!== $country->map->__toString()) {
                    $incarnateLoreCountry->setMap($country->map->__toString());
                }
                $incarnateLoreCountry->setType($this->incImportType['loreCountry']);
                $incarnateLoreCountry->setUgfid($country['UGF']);
                $incarnateLoreCountry->setIncarnateLorePlanet($incarnateLorePlanet);
                $this->setupState($incarnateLoreCountry,$country);
                if($country->pointsOfInterest) {
                    foreach ($country->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                        $newPoi = $this->setupPOI($pointOfInterest);
                        $newPoi->setIncarnateLoreCountry($incarnateLoreCountry);
                        $this->em->persist($newPoi);
                    }
                }
                $this->em->persist($incarnateLoreCountry);
            }
        }
    }
    public function setupState(IncarnateLoreCountry $incarnateLoreCountry, \SimpleXMLElement $country){
        if($country->states){
            foreach ($country->states->state as $state){
                $incarnateLoreState = new IncarnateLoreState();
                $incarnateLoreState->setAuthor($state->author->__toString());
                $incarnateLoreState->setDescription($this->functions->formatParagraphs($state->description));
                $incarnateLoreState->setFid($state['FID']);
                $incarnateLoreState->setOfficial('false');
                $incarnateLoreState->setName($state->name->__toString());
                if(''!==$state->map->__toString()) {
                    $incarnateLoreState->setMap($state->map->__toString());
                }
                $incarnateLoreState->setType($this->incImportType['loreState']);
                $incarnateLoreState->setUgfid($state['UGF']);
                $incarnateLoreState->setIncarnateLoreCountry($incarnateLoreCountry);
                $this->setupCity($incarnateLoreState,$state);
                if($state->pointsOfInterest) {
                    foreach ($state->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                        $newPoi = $this->setupPOI($pointOfInterest);
                        $newPoi->setIncarnateLoreState($incarnateLoreState);
                        $this->em->persist($newPoi);
                    }
                }
                $this->em->persist($incarnateLoreState);
            }
        }
    }
    public function setupCity(IncarnateLoreState $incarnateLoreState,\SimpleXMLElement $state){
        if($state->cities){
            foreach ($state->cities->city as $city){
                $incarnateLoreCity = new IncarnateLoreCity();
                $incarnateLoreCity->setAuthor($city->author->__toString());
                $incarnateLoreCity->setDescription($this->functions->formatParagraphs($city->description));
                $incarnateLoreCity->setFid($city['FID']);
                $incarnateLoreCity->setOfficial('false');
                $incarnateLoreCity->setName($city->name->__toString());
                if(''!==$city->map->__toString()) {
                    $incarnateLoreCity->setMap($city->map->__toString());
                }
                $incarnateLoreCity->setType($this->incImportType['loreCity']);
                $incarnateLoreCity->setUgfid($city['UGF']);
                $incarnateLoreCity->setIncarnateLoreState($incarnateLoreState);
                $this->setupDistrict($incarnateLoreCity,$city);
                if($city->pointsOfInterest) {
                    foreach ($city->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                        $newPoi = $this->setupPOI($pointOfInterest);
                        $newPoi->setIncarnateLoreCity($incarnateLoreCity);
                        $this->em->persist($newPoi);
                    }
                }
                $this->em->persist($incarnateLoreCity);
            }
        }
    }
    public function setupDistrict(IncarnateLoreCity $incarnateLoreCity, \SimpleXMLElement $city){
        if($city->districts){
            foreach($city->districts->district as $district){
                $incarnateLoreDistrict = new IncarnateLoreDistrict();
                $incarnateLoreDistrict->setAuthor($district->author->__toString());
                $incarnateLoreDistrict->setDescription($this->functions->formatParagraphs($district->description));
                $incarnateLoreDistrict->setFid($district['FID']);
                $incarnateLoreDistrict->setOfficial('false');
                $incarnateLoreDistrict->setName($district->name->__toString());
                if(''!==$district->map->__toString()) {
                    $incarnateLoreDistrict->setMap($district->map->__toString());
                }
                $incarnateLoreDistrict->setType($this->incImportType['loreDistrict']);
                $incarnateLoreDistrict->setUgfid($district['UGF']);
                $incarnateLoreDistrict->setIncarnateLoreCity($incarnateLoreCity);
                $this->setupBuilding($incarnateLoreDistrict,$district);
                if($district->pointsOfInterest) {
                    foreach ($district->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                        $newPoi = $this->setupPOI($pointOfInterest);
                        $newPoi->setIncarnateLoreDistrict($incarnateLoreDistrict);
                        $this->em->persist($newPoi);
                    }
                }
                $this->em->persist($incarnateLoreDistrict);
            }
        }
    }
    public function setupBuilding(IncarnateLoreDistrict $incarnateLoreDistrict, \SimpleXMLElement $district){
        if($district->buildings){
            foreach ($district->buildings->building as $building){
                $incarnateLoreBuilding = new IncarnateLoreBuildings();
                $incarnateLoreBuilding->setAuthor($building->author->__toString());
                $incarnateLoreBuilding->setDescription($this->functions->formatParagraphs($building->description));
                $incarnateLoreBuilding->setFid($building['FID']);
                $incarnateLoreBuilding->setOfficial('false');
                $incarnateLoreBuilding->setName($building->name->__toString());
                if(''!==$building->map->__toString()) {
                    $incarnateLoreBuilding->setMap($building->map->__toString());
                }
                $incarnateLoreBuilding->setType($this->incImportType['loreBuilding']);
                $incarnateLoreBuilding->setUgfid($building['UGF']);
                $incarnateLoreBuilding->setIncarnateLoreDistrict($incarnateLoreDistrict);
                if($building->pointsOfInterest) {
                    foreach ($building->pointsOfInterest->pointOfInterest as $pointOfInterest) {
                        $newPoi = $this->setupPOI($pointOfInterest);
                        $newPoi->setIncarnateLoreBuildings($incarnateLoreBuilding);
                        $this->em->persist($newPoi);
                    }
                }
                if($building->citizens){
                    foreach ($building->citizens->citizen as $citizen){
                        $incarnateLoreCitizen = $this->setupCitizen($citizen);
                        if ($incarnateLoreCitizen!==false){
                            $incarnateLoreCitizen->setIncarnateLoreBuilding($incarnateLoreBuilding);
                            $this->em->persist($incarnateLoreCitizen);
                        }
                    }
                }
                $this->em->persist($incarnateLoreBuilding);
            }
        }
    }
    public function setupPOI(\SimpleXMLElement $simpleXMLElement):IncarnateLorePointOfInterest{
        $new = new IncarnateLorePointOfInterest();
        $new->setAuthor($simpleXMLElement->author->__toString());
        $new->setDescription($this->functions->formatParagraphs($simpleXMLElement->description));
        $new->setFid($simpleXMLElement['FID']);
        if ('' !== $simpleXMLElement->map->__toString()) {
            $new->setMap($simpleXMLElement->map->__toString());
        }
        $new->setName($simpleXMLElement->name->__toString());
        $new->setOfficial('false');
        $new->setType($this->incImportType['lorePointOfInterest']);
        $new->setUgfid($simpleXMLElement['UGF']);
        $this->setupSubPOI($simpleXMLElement,$new);
        if($simpleXMLElement->citizens){
            foreach ($simpleXMLElement->citizens->citizen as $citizen){
                $incarnateLoreCitizen = $this->setupCitizen($citizen);
                if ($incarnateLoreCitizen!==false){
                    $incarnateLoreCitizen->setIncarnateLoreSubpoint($new);
                    $this->em->persist($incarnateLoreCitizen);
                }
            }
        }
        return $new;
    }
    public function setupSubPOI(\SimpleXMLElement $pointOfInterest, IncarnateLorePointOfInterest $incarnateLorePointOfInterest){
        if($pointOfInterest->subPoints){
            foreach ($pointOfInterest->subPoints->subPoint as $subpoi){
                $new = new IncarnateLoreSubpoint();
                $new->setAuthor($subpoi->author->__toString());
                $new->setDescription($this->functions->formatParagraphs($subpoi->description));
                if(''!== $subpoi->map->__toString()) {
                    $new->setMap($subpoi->map->__toString());
                }
                $new->setName($subpoi->name->__toString());
                $new->setOfficial('false');
                $new->setFid($subpoi['FID']);
                $new->setType($this->incImportType['loreSubpoint']);
                $new->setUgfid($subpoi['UGF']);
                $new->setIncarnateLorePointOfInterest($incarnateLorePointOfInterest);
                $this->em->persist($new);
            }
        }
    }
    public function setupCitizen(\SimpleXMLElement $citizen){
//        TODO write citizen import script, dependant on spells and equipment completion
        return false;
    }
}