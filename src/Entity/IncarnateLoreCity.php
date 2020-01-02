<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreCityRepository")
 */
class IncarnateLoreCity extends IncarnateItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreState", inversedBy="incarnateLoreCities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateLoreState;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePointOfInterest", mappedBy="incarnateLoreCity")
     */
    private $incarnateLorePointsOfInterest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreDistrict", mappedBy="incarnateLoreCity")
     */
    private $incarnateLoreDistricts;

    public function __construct()
    {
        $this->incarnateLorePointsOfInterest = new ArrayCollection();
        $this->incarnateLoreDistricts = new ArrayCollection();
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

    public function getIncarnateLoreState(): ?IncarnateLoreState
    {
        return $this->incarnateLoreState;
    }

    public function setIncarnateLoreState(?IncarnateLoreState $incarnateLoreState): self
    {
        $this->incarnateLoreState = $incarnateLoreState;

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
            $incarnateLorePointsOfInterest->setIncarnateLoreCity($this);
        }

        return $this;
    }

    public function removeIncarnateLorePointsOfInterest(IncarnateLorePointOfInterest $incarnateLorePointsOfInterest): self
    {
        if ($this->incarnateLorePointsOfInterest->contains($incarnateLorePointsOfInterest)) {
            $this->incarnateLorePointsOfInterest->removeElement($incarnateLorePointsOfInterest);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePointsOfInterest->getIncarnateLoreCity() === $this) {
                $incarnateLorePointsOfInterest->setIncarnateLoreCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreDistrict[]
     */
    public function getIncarnateLoreDistricts(): Collection
    {
        return $this->incarnateLoreDistricts;
    }

    public function addIncarnateLoreDistrict(IncarnateLoreDistrict $incarnateLoreDistrict): self
    {
        if (!$this->incarnateLoreDistricts->contains($incarnateLoreDistrict)) {
            $this->incarnateLoreDistricts[] = $incarnateLoreDistrict;
            $incarnateLoreDistrict->setIncarnateLoreCity($this);
        }

        return $this;
    }

    public function removeIncarnateLoreDistrict(IncarnateLoreDistrict $incarnateLoreDistrict): self
    {
        if ($this->incarnateLoreDistricts->contains($incarnateLoreDistrict)) {
            $this->incarnateLoreDistricts->removeElement($incarnateLoreDistrict);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreDistrict->getIncarnateLoreCity() === $this) {
                $incarnateLoreDistrict->setIncarnateLoreCity(null);
            }
        }

        return $this;
    }
}
