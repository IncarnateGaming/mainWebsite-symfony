<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateClassArchetypeRepository")
 */
class IncarnateClassArchetype extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $equipment = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $spellcasting = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateClass", inversedBy="incarnateClassArchetypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateClass;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateClassArchetypeTrait", mappedBy="incarnateClassArchetype")
     */
    private $incarnateClassArchetypeTraits;

    public function __construct()
    {
        $this->incarnateClassArchetypeTraits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipment(): ?array
    {
        return $this->equipment;
    }

    public function setEquipment(?array $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getSpellcasting(): ?array
    {
        return $this->spellcasting;
    }

    public function setSpellcasting(?array $spellcasting): self
    {
        $this->spellcasting = $spellcasting;

        return $this;
    }

    public function getIncarnateClass(): ?IncarnateClass
    {
        return $this->incarnateClass;
    }

    public function setIncarnateClass(?IncarnateClass $incarnateClass): self
    {
        $this->incarnateClass = $incarnateClass;

        return $this;
    }

    /**
     * @return Collection|IncarnateClassArchetypeTrait[]
     */
    public function getIncarnateClassArchetypeTraits(): Collection
    {
        return $this->incarnateClassArchetypeTraits;
    }

    public function addIncarnateClassArchetypeTrait(IncarnateClassArchetypeTrait $incarnateClassArchetypeTrait): self
    {
        if (!$this->incarnateClassArchetypeTraits->contains($incarnateClassArchetypeTrait)) {
            $this->incarnateClassArchetypeTraits[] = $incarnateClassArchetypeTrait;
            $incarnateClassArchetypeTrait->setIncarnateClassArchetype($this);
        }

        return $this;
    }

    public function removeIncarnateClassArchetypeTrait(IncarnateClassArchetypeTrait $incarnateClassArchetypeTrait): self
    {
        if ($this->incarnateClassArchetypeTraits->contains($incarnateClassArchetypeTrait)) {
            $this->incarnateClassArchetypeTraits->removeElement($incarnateClassArchetypeTrait);
            // set the owning side to null (unless already changed)
            if ($incarnateClassArchetypeTrait->getIncarnateClassArchetype() === $this) {
                $incarnateClassArchetypeTrait->setIncarnateClassArchetype(null);
            }
        }

        return $this;
    }
}
