<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreCountryRepository")
 */
class IncarnateLoreCountry extends IncarnateItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLorePlanet", inversedBy="incarnateLoreCountries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateLorePlanet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePointOfInterest", mappedBy="incarnateLoreCountry")
     */
    private $incarnateLorePointOfInterest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreState", mappedBy="incarnateLoreCountry")
     */
    private $incarnateLoreStates;

    public function __construct()
    {
        $this->incarnateLorePointOfInterest = new ArrayCollection();
        $this->incarnateLoreStates = new ArrayCollection();
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

    public function getIncarnateLorePlanet(): ?IncarnateLorePlanet
    {
        return $this->incarnateLorePlanet;
    }

    public function setIncarnateLorePlanet(?IncarnateLorePlanet $incarnateLorePlanet): self
    {
        $this->incarnateLorePlanet = $incarnateLorePlanet;

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
            $incarnateLorePointOfInterest->setIncarnateLoreCountry($this);
        }

        return $this;
    }

    public function removeIncarnateLorePointOfInterest(IncarnateLorePointOfInterest $incarnateLorePointOfInterest): self
    {
        if ($this->incarnateLorePointOfInterest->contains($incarnateLorePointOfInterest)) {
            $this->incarnateLorePointOfInterest->removeElement($incarnateLorePointOfInterest);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePointOfInterest->getIncarnateLoreCountry() === $this) {
                $incarnateLorePointOfInterest->setIncarnateLoreCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreState[]
     */
    public function getIncarnateLoreStates(): Collection
    {
        return $this->incarnateLoreStates;
    }

    public function addIncarnateLoreState(IncarnateLoreState $incarnateLoreState): self
    {
        if (!$this->incarnateLoreStates->contains($incarnateLoreState)) {
            $this->incarnateLoreStates[] = $incarnateLoreState;
            $incarnateLoreState->setIncarnateLoreCountry($this);
        }

        return $this;
    }

    public function removeIncarnateLoreState(IncarnateLoreState $incarnateLoreState): self
    {
        if ($this->incarnateLoreStates->contains($incarnateLoreState)) {
            $this->incarnateLoreStates->removeElement($incarnateLoreState);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreState->getIncarnateLoreCountry() === $this) {
                $incarnateLoreState->setIncarnateLoreCountry(null);
            }
        }

        return $this;
    }

}
