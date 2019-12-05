<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateClassRepository")
 */
class IncarnateClass extends IncarnateItem
{

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
     * @ORM\Column(type="array")
     */
    private $trait = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $darkvision;

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

    public function getTrait(): ?array
    {
        return $this->trait;
    }

    public function setTrait(array $trait): self
    {
        $this->trait = $trait;

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
}
