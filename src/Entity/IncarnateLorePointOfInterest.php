<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLorePointOfInterestRepository")
 */
class IncarnateLorePointOfInterest extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $map;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreSubpoint", mappedBy="IncarnateLorePointOfInterest")
     */
    private $incarnateLoreSubpoints;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLorePlanet", inversedBy="incarnateLorePointOfInterest")
     */
    private $incarnateLorePlanet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreCountry", inversedBy="incarnateLorePointOfInterest")
     */
    private $incarnateLoreCountry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreState", inversedBy="incarnateLorePointsOfInterest")
     */
    private $incarnateLoreState;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreCity", inversedBy="incarnateLorePointsOfInterest")
     */
    private $incarnateLoreCity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreDistrict", inversedBy="incarnateLorePointsOfInterest")
     */
    private $incarnateLoreDistrict;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreBuildings", inversedBy="incarnateLorePointsOfInterest")
     */
    private $incarnateLoreBuildings;

    public function __construct()
    {
        $this->incarnateLoreSubpoints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(?string $map): self
    {
        $this->map = $map;

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreSubpoint[]
     */
    public function getIncarnateLoreSubpoints(): Collection
    {
        return $this->incarnateLoreSubpoints;
    }

    public function addIncarnateLoreSubpoint(IncarnateLoreSubpoint $incarnateLoreSubpoint): self
    {
        if (!$this->incarnateLoreSubpoints->contains($incarnateLoreSubpoint)) {
            $this->incarnateLoreSubpoints[] = $incarnateLoreSubpoint;
            $incarnateLoreSubpoint->setIncarnateLorePointOfInterest($this);
        }

        return $this;
    }

    public function removeIncarnateLoreSubpoint(IncarnateLoreSubpoint $incarnateLoreSubpoint): self
    {
        if ($this->incarnateLoreSubpoints->contains($incarnateLoreSubpoint)) {
            $this->incarnateLoreSubpoints->removeElement($incarnateLoreSubpoint);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreSubpoint->getIncarnateLorePointOfInterest() === $this) {
                $incarnateLoreSubpoint->setIncarnateLorePointOfInterest(null);
            }
        }

        return $this;
    }

    public function getIncarnateLorePlanet(): ?IncarnateLorePlanet
    {
        return $this->incarnateLorePlanet;
    }

    public function setIncarnateLorePlanet(?IncarnateLorePlanet $incarnateLorePlanet): self
    {
        $this->incarnateLorePlanet = $incarnateLorePlanet;

        return $this;
    }

    public function getIncarnateLoreCountry(): ?IncarnateLoreCountry
    {
        return $this->incarnateLoreCountry;
    }

    public function setIncarnateLoreCountry(?IncarnateLoreCountry $incarnateLoreCountry): self
    {
        $this->incarnateLoreCountry = $incarnateLoreCountry;

        return $this;
    }

    public function getIncarnateLoreState(): ?IncarnateLoreState
    {
        return $this->incarnateLoreState;
    }

    public function setIncarnateLoreState(?IncarnateLoreState $incarnateLoreState): self
    {
        $this->incarnateLoreState = $incarnateLoreState;

        return $this;
    }

    public function getIncarnateLoreCity(): ?IncarnateLoreCity
    {
        return $this->incarnateLoreCity;
    }

    public function setIncarnateLoreCity(?IncarnateLoreCity $incarnateLoreCity): self
    {
        $this->incarnateLoreCity = $incarnateLoreCity;

        return $this;
    }

    public function getIncarnateLoreDistrict(): ?IncarnateLoreDistrict
    {
        return $this->incarnateLoreDistrict;
    }

    public function setIncarnateLoreDistrict(?IncarnateLoreDistrict $incarnateLoreDistrict): self
    {
        $this->incarnateLoreDistrict = $incarnateLoreDistrict;

        return $this;
    }

    public function getIncarnateLoreBuildings(): ?IncarnateLoreBuildings
    {
        return $this->incarnateLoreBuildings;
    }

    public function setIncarnateLoreBuildings(?IncarnateLoreBuildings $incarnateLoreBuildings): self
    {
        $this->incarnateLoreBuildings = $incarnateLoreBuildings;

        return $this;
    }
}
