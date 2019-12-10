<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateClassRepository")
 */
class IncarnateClass extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $classAmmendment;

    /**
     * @ORM\Column(type="array")
     */
    private $archetype = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $equipment = [];

    /**
     * @ORM\Column(type="array")
     */
    private $hitpoints = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $multiclass = [];

    /**
     * @ORM\Column(type="array")
     */
    private $proficiencies = [];

    /**
     * @ORM\Column(type="text")
     */
    private $leveltable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $darkvision;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateClassTrait", mappedBy="incarnateClass")
     */
    private $incarnateClassTraits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateClassArchetype", mappedBy="incarnateClass")
     */
    private $incarnateClassArchetypes;

    /**
     * @ORM\Column(type="array")
     */
    private $archetypeInfo = [];

    public function __construct()
    {
        $this->incarnateClassTraits = new ArrayCollection();
        $this->incarnateClassArchetypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassAmmendment(): ?string
    {
        return $this->classAmmendment;
    }

    public function setClassAmmendment(?string $classAmmendment): self
    {
        $this->classAmmendment = $classAmmendment;

        return $this;
    }

    public function getArchetype(): ?array
    {
        return $this->archetype;
    }

    public function setArchetype(array $archetype): self
    {
        $this->archetype = $archetype;

        return $this;
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

    public function getHitpoints(): ?array
    {
        return $this->hitpoints;
    }

    public function setHitpoints(array $hitpoints): self
    {
        $this->hitpoints = $hitpoints;

        return $this;
    }

    public function getMulticlass(): ?array
    {
        return $this->multiclass;
    }

    public function setMulticlass(?array $multiclass): self
    {
        $this->multiclass = $multiclass;

        return $this;
    }

    public function getProficiencies(): ?array
    {
        return $this->proficiencies;
    }

    public function setProficiencies(array $proficiencies): self
    {
        $this->proficiencies = $proficiencies;

        return $this;
    }

    public function getLeveltable(): ?string
    {
        return $this->leveltable;
    }

    public function setLeveltable(string $leveltable): self
    {
        $this->leveltable = $leveltable;

        return $this;
    }

    public function getDarkvision(): ?int
    {
        return $this->darkvision;
    }

    public function setDarkvision(?int $darkvision): self
    {
        $this->darkvision = $darkvision;

        return $this;
    }

    /**
     * @return Collection|IncarnateClassTrait[]
     */
    public function getIncarnateClassTraits(): Collection
    {
        return $this->incarnateClassTraits;
    }

    public function addIncarnateClassTrait(IncarnateClassTrait $incarnateClassTrait): self
    {
        if (!$this->incarnateClassTraits->contains($incarnateClassTrait)) {
            $this->incarnateClassTraits[] = $incarnateClassTrait;
            $incarnateClassTrait->setIncarnateClass($this);
        }

        return $this;
    }

    public function removeIncarnateClassTrait(IncarnateClassTrait $incarnateClassTrait): self
    {
        if ($this->incarnateClassTraits->contains($incarnateClassTrait)) {
            $this->incarnateClassTraits->removeElement($incarnateClassTrait);
            // set the owning side to null (unless already changed)
            if ($incarnateClassTrait->getIncarnateClass() === $this) {
                $incarnateClassTrait->setIncarnateClass(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IncarnateClassArchetype[]
     */
    public function getIncarnateClassArchetypes(): Collection
    {
        return $this->incarnateClassArchetypes;
    }

    public function addIncarnateClassArchetype(IncarnateClassArchetype $incarnateClassArchetype): self
    {
        if (!$this->incarnateClassArchetypes->contains($incarnateClassArchetype)) {
            $this->incarnateClassArchetypes[] = $incarnateClassArchetype;
            $incarnateClassArchetype->setIncarnateClass($this);
        }

        return $this;
    }

    public function removeIncarnateClassArchetype(IncarnateClassArchetype $incarnateClassArchetype): self
    {
        if ($this->incarnateClassArchetypes->contains($incarnateClassArchetype)) {
            $this->incarnateClassArchetypes->removeElement($incarnateClassArchetype);
            // set the owning side to null (unless already changed)
            if ($incarnateClassArchetype->getIncarnateClass() === $this) {
                $incarnateClassArchetype->setIncarnateClass(null);
            }
        }

        return $this;
    }

    public function getArchetypeInfo(): ?array
    {
        return $this->archetypeInfo;
    }

    public function setArchetypeInfo(array $archetypeInfo): self
    {
        $this->archetypeInfo = $archetypeInfo;

        return $this;
    }
}
