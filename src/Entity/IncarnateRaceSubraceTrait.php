<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateRaceSubraceTraitRepository")
 */
class IncarnateRaceSubraceTrait extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateRaceSubrace", inversedBy="incarnateRaceSubraceTraits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subrace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubrace(): ?IncarnateRaceSubrace
    {
        return $this->subrace;
    }

    public function setSubrace(?IncarnateRaceSubrace $subrace): self
    {
        $this->subrace = $subrace;

        return $this;
    }
}
