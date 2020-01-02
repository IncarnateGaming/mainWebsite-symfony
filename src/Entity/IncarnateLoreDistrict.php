<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreDistrictRepository")
 */
class IncarnateLoreDistrict extends IncarnateItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreCity", inversedBy="incarnateLoreDistricts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateLoreCity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePointOfInterest", mappedBy="incarnateLoreDistrict")
     */
    private $incarnateLorePointsOfInterest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreBuildings", mappedBy="incarnateLoreDistrict")
     */
    private $incarnateLoreBuildings;

    public function __construct()
    {
        $this->incarnateLorePointsOfInterest = new ArrayCollection();
        $this->incarnateLoreBuildings = new ArrayCollection();
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

    public function getIncarnateLoreCity(): ?IncarnateLoreCity
    {
        return $this->incarnateLoreCity;
    }

    public function setIncarnateLoreCity(?IncarnateLoreCity $incarnateLoreCity): self
    {
        $this->incarnateLoreCity = $incarnateLoreCity;

        return $this;
    }

    /**
     * @return Collection|IncarnateLorePointOfInterest[]
     */
    public function getIncarnateLorePointsOfInterest(): Collection
    {
        return $this->incarnateLorePointsOfInterest;
    }

    public function addIncarnateLorePointsOfInterest(IncarnateLorePointOfInterest $incarnateLorePointsOfInterest): self
    {
        if (!$this->incarnateLorePointsOfInterest->contains($incarnateLorePointsOfInterest)) {
            $this->incarnateLorePointsOfInterest[] = $incarnateLorePointsOfInterest;
            $incarnateLorePointsOfInterest->setIncarnateLoreDistrict($this);
        }

        return $this;
    }

    public function removeIncarnateLorePointsOfInterest(IncarnateLorePointOfInterest $incarnateLorePointsOfInterest): self
    {
        if ($this->incarnateLorePointsOfInterest->contains($incarnateLorePointsOfInterest)) {
            $this->incarnateLorePointsOfInterest->removeElement($incarnateLorePointsOfInterest);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePointsOfInterest->getIncarnateLoreDistrict() === $this) {
                $incarnateLorePointsOfInterest->setIncarnateLoreDistrict(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreBuildings[]
     */
    public function getIncarnateLoreBuildings(): Collection
    {
        return $this->incarnateLoreBuildings;
    }

    public function addIncarnateLoreBuilding(IncarnateLoreBuildings $incarnateLoreBuilding): self
    {
        if (!$this->incarnateLoreBuildings->contains($incarnateLoreBuilding)) {
            $this->incarnateLoreBuildings[] = $incarnateLoreBuilding;
            $incarnateLoreBuilding->setIncarnateLoreDistrict($this);
        }

        return $this;
    }

    public function removeIncarnateLoreBuilding(IncarnateLoreBuildings $incarnateLoreBuilding): self
    {
        if ($this->incarnateLoreBuildings->contains($incarnateLoreBuilding)) {
            $this->incarnateLoreBuildings->removeElement($incarnateLoreBuilding);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreBuilding->getIncarnateLoreDistrict() === $this) {
                $incarnateLoreBuilding->setIncarnateLoreDistrict(null);
            }
        }

        return $this;
    }
}
