<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreBuildingsRepository")
 */
class IncarnateLoreBuildings extends IncarnateItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreDistrict", inversedBy="incarnateLoreBuildings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateLoreDistrict;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePointOfInterest", mappedBy="incarnateLoreBuildings")
     */
    private $incarnateLorePointsOfInterest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreCitizen", mappedBy="incarnateLoreBuilding")
     */
    private $incarnateLoreCitizens;

    public function __construct()
    {
        $this->incarnateLorePointsOfInterest = new ArrayCollection();
        $this->incarnateLoreCitizens = new ArrayCollection();
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

    public function getIncarnateLoreDistrict(): ?IncarnateLoreDistrict
    {
        return $this->incarnateLoreDistrict;
    }

    public function setIncarnateLoreDistrict(?IncarnateLoreDistrict $incarnateLoreDistrict): self
    {
        $this->incarnateLoreDistrict = $incarnateLoreDistrict;

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
            $incarnateLorePointsOfInterest->setIncarnateLoreBuildings($this);
        }

        return $this;
    }

    public function removeIncarnateLorePointsOfInterest(IncarnateLorePointOfInterest $incarnateLorePointsOfInterest): self
    {
        if ($this->incarnateLorePointsOfInterest->contains($incarnateLorePointsOfInterest)) {
            $this->incarnateLorePointsOfInterest->removeElement($incarnateLorePointsOfInterest);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePointsOfInterest->getIncarnateLoreBuildings() === $this) {
                $incarnateLorePointsOfInterest->setIncarnateLoreBuildings(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreCitizen[]
     */
    public function getIncarnateLoreCitizens(): Collection
    {
        return $this->incarnateLoreCitizens;
    }

    public function addIncarnateLoreCitizen(IncarnateLoreCitizen $incarnateLoreCitizen): self
    {
        if (!$this->incarnateLoreCitizens->contains($incarnateLoreCitizen)) {
            $this->incarnateLoreCitizens[] = $incarnateLoreCitizen;
            $incarnateLoreCitizen->setIncarnateLoreBuilding($this);
        }

        return $this;
    }

    public function removeIncarnateLoreCitizen(IncarnateLoreCitizen $incarnateLoreCitizen): self
    {
        if ($this->incarnateLoreCitizens->contains($incarnateLoreCitizen)) {
            $this->incarnateLoreCitizens->removeElement($incarnateLoreCitizen);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreCitizen->getIncarnateLoreBuilding() === $this) {
                $incarnateLoreCitizen->setIncarnateLoreBuilding(null);
            }
        }

        return $this;
    }
}
