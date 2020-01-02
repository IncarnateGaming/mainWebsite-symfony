<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreSubpointRepository")
 */
class IncarnateLoreSubpoint extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLorePointOfInterest", inversedBy="incarnateLoreSubpoints")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IncarnateLorePointOfInterest;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $map;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreCitizen", mappedBy="incarnateLoreSubpoint")
     */
    private $incarnateLoreCitizens;

    public function __construct()
    {
        $this->incarnateLoreCitizens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIncarnateLorePointOfInterest(): ?IncarnateLorePointOfInterest
    {
        return $this->IncarnateLorePointOfInterest;
    }

    public function setIncarnateLorePointOfInterest(?IncarnateLorePointOfInterest $IncarnateLorePointOfInterest): self
    {
        $this->IncarnateLorePointOfInterest = $IncarnateLorePointOfInterest;

        return $this;
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
            $incarnateLoreCitizen->setIncarnateLoreSubpoint($this);
        }

        return $this;
    }

    public function removeIncarnateLoreCitizen(IncarnateLoreCitizen $incarnateLoreCitizen): self
    {
        if ($this->incarnateLoreCitizens->contains($incarnateLoreCitizen)) {
            $this->incarnateLoreCitizens->removeElement($incarnateLoreCitizen);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreCitizen->getIncarnateLoreSubpoint() === $this) {
                $incarnateLoreCitizen->setIncarnateLoreSubpoint(null);
            }
        }

        return $this;
    }
}
