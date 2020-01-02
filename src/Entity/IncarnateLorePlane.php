<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLorePlaneRepository")
 */
class IncarnateLorePlane extends IncarnateItem
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
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLorePlanet", mappedBy="incarnateLorePlane")
     */
    private $incarnateLorePlanets;

    public function __construct()
    {
        $this->incarnateLorePlanets = new ArrayCollection();
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
     * @return Collection|IncarnateLorePlanet[]
     */
    public function getIncarnateLorePlanets(): Collection
    {
        return $this->incarnateLorePlanets;
    }

    public function addIncarnateLorePlanet(IncarnateLorePlanet $incarnateLorePlanet): self
    {
        if (!$this->incarnateLorePlanets->contains($incarnateLorePlanet)) {
            $this->incarnateLorePlanets[] = $incarnateLorePlanet;
            $incarnateLorePlanet->setIncarnateLorePlane($this);
        }

        return $this;
    }

    public function removeIncarnateLorePlanet(IncarnateLorePlanet $incarnateLorePlanet): self
    {
        if ($this->incarnateLorePlanets->contains($incarnateLorePlanet)) {
            $this->incarnateLorePlanets->removeElement($incarnateLorePlanet);
            // set the owning side to null (unless already changed)
            if ($incarnateLorePlanet->getIncarnateLorePlane() === $this) {
                $incarnateLorePlanet->setIncarnateLorePlane(null);
            }
        }

        return $this;
    }
}
