<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLorePlanetRepository")
 */
class IncarnateLorePlanet extends IncarnateItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLorePlane", inversedBy="incarnateLorePlanets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateLorePlane;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePointOfInterest", mappedBy="incarnateLorePlanet")
     */
    private $incarnateLorePointOfInterest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreCountry", mappedBy="incarnateLorePlanet")
     */
    private $incarnateLoreCountries;

    public function __construct()
    {
        $this->incarnateLorePointOfInterest = new ArrayCollection();
        $this->incarnateLoreCountries = new ArrayCollection();
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

    public function getIncarnateLorePlane(): ?IncarnateLorePlane
    {
        return $this->incarnateLorePlane;
    }

    public function setIncarnateLorePlane(?IncarnateLorePlane $incarnateLorePlane): self
    {
        $this->incarnateLorePlane = $incarnateLorePlane;

        return $this;
    }

    /**
     * @return Collection|IncarnateLorePointOfInterest[]
     */
    public function getIncarnateLorePointOfInterest(): Collection
    {
        return $this->incarnateLorePointOfInterest;
    }

    public function addIncarnateLorePointOfInterest(IncarnateLorePointOfInterest $incarnateLorePointOfInterest): self
    {
        if (!$this->incarnateLorePointOfInterest->contains($incarnateLorePointOfInterest)) {
            $this->incarnateLorePointOfInterest[] = $incarnateLorePointOfInterest;
            $incarnateLorePointOfInterest->setIncarnateLorePlanet($this);
        }

        return $this;
    }

    public function removeIncarnateLorePointOfInterest(IncarnateLorePointOfInterest $incarnateLorePointOfInterest): self
    {
        if ($this->incarnateLorePointOfInterest->contains($incarnateLorePointOfInterest)) {
            $this->incarnateLorePointOfInterest->removeElement($incarnateLorePointOfInterest);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePointOfInterest->getIncarnateLorePlanet() === $this) {
                $incarnateLorePointOfInterest->setIncarnateLorePlanet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreCountry[]
     */
    public function getIncarnateLoreCountries(): Collection
    {
        return $this->incarnateLoreCountries;
    }

    public function addIncarnateLoreCountry(IncarnateLoreCountry $incarnateLoreCountry): self
    {
        if (!$this->incarnateLoreCountries->contains($incarnateLoreCountry)) {
            $this->incarnateLoreCountries[] = $incarnateLoreCountry;
            $incarnateLoreCountry->setIncarnateLorePlanet($this);
        }

        return $this;
    }

    public function removeIncarnateLoreCountry(IncarnateLoreCountry $incarnateLoreCountry): self
    {
        if ($this->incarnateLoreCountries->contains($incarnateLoreCountry)) {
            $this->incarnateLoreCountries->removeElement($incarnateLoreCountry);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreCountry->getIncarnateLorePlanet() === $this) {
                $incarnateLoreCountry->setIncarnateLorePlanet(null);
            }
        }

        return $this;
    }
}
