<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateRaceTraitRepository")
 */
class IncarnateRaceTrait extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateRace", inversedBy="incarnateRaceTraits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?IncarnateRace
    {
        return $this->race;
    }

    public function setRace(?IncarnateRace $race): self
    {
        $this->race = $race;

        return $this;
    }
}
