<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateClassArchetypeTraitRepository")
 */
class IncarnateClassArchetypeTrait extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateClassArchetype", inversedBy="incarnateClassArchetypeTraits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateClassArchetype;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getIncarnateClassArchetype(): ?IncarnateClassArchetype
    {
        return $this->incarnateClassArchetype;
    }

    public function setIncarnateClassArchetype(?IncarnateClassArchetype $incarnateClassArchetype): self
    {
        $this->incarnateClassArchetype = $incarnateClassArchetype;

        return $this;
    }
}
