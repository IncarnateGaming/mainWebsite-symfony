<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreStateRepository")
 */
class IncarnateLoreState extends IncarnateItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreCountry", inversedBy="incarnateLoreStates")
     */
    private $incarnateLoreCountry;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePointOfInterest", mappedBy="incarnateLoreState")
     */
    private $incarnateLorePointsOfInterest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreCity", mappedBy="incarnateLoreState")
     */
    private $incarnateLoreCities;

    public function __construct()
    {
        $this->incarnateLorePointsOfInterest = new ArrayCollection();
        $this->incarnateLoreCities = new ArrayCollection();
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

    public function getIncarnateLoreCountry(): ?IncarnateLoreCountry
    {
        return $this->incarnateLoreCountry;
    }

    public function setIncarnateLoreCountry(?IncarnateLoreCountry $incarnateLoreCountry): self
    {
        $this->incarnateLoreCountry = $incarnateLoreCountry;

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
            $incarnateLorePointsOfInterest->setIncarnateLoreState($this);
        }

        return $this;
    }

    public function removeIncarnateLorePointsOfInterest(IncarnateLorePointOfInterest $incarnateLorePointsOfInterest): self
    {
        if ($this->incarnateLorePointsOfInterest->contains($incarnateLorePointsOfInterest)) {
            $this->incarnateLorePointsOfInterest->removeElement($incarnateLorePointsOfInterest);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePointsOfInterest->getIncarnateLoreState() === $this) {
                $incarnateLorePointsOfInterest->setIncarnateLoreState(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreCity[]
     */
    public function getIncarnateLoreCities(): Collection
    {
        return $this->incarnateLoreCities;
    }

    public function addIncarnateLoreCity(IncarnateLoreCity $incarnateLoreCity): self
    {
        if (!$this->incarnateLoreCities->contains($incarnateLoreCity)) {
            $this->incarnateLoreCities[] = $incarnateLoreCity;
            $incarnateLoreCity->setIncarnateLoreState($this);
        }

        return $this;
    }

    public function removeIncarnateLoreCity(IncarnateLoreCity $incarnateLoreCity): self
    {
        if ($this->incarnateLoreCities->contains($incarnateLoreCity)) {
            $this->incarnateLoreCities->removeElement($incarnateLoreCity);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreCity->getIncarnateLoreState() === $this) {
                $incarnateLoreCity->setIncarnateLoreState(null);
            }
        }

        return $this;
    }
}
