<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateEquipmentRepository")
 */
class IncarnateEquipment extends IncarnateItem
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $gmonly;

    /**
     * @ORM\Column(type="boolean")
     */
    private $magical;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mundane;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $ac = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carryingcapacity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $holdingcapacity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cost;

    /**
     * @ORM\Column(type="float")
     */
    private $costSortable;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $damage = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recommendedlevel;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $consumable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $offensebonus;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $properties = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $itemrange;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rarity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stealth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $strengthrequirement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtype;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipmentType;

    public function getGmonly(): ?bool
    {
        return $this->gmonly;
    }

    public function setGmonly(bool $gmonly): self
    {
        $this->gmonly = $gmonly;

        return $this;
    }

    public function getMagical(): ?bool
    {
        return $this->magical;
    }

    public function setMagical(bool $magical): self
    {
        $this->magical = $magical;

        return $this;
    }

    public function getMundane(): ?bool
    {
        return $this->mundane;
    }

    public function setMundane(bool $mundane): self
    {
        $this->mundane = $mundane;

        return $this;
    }

    public function getAc(): ?array
    {
        return $this->ac;
    }

    public function setAc(?array $ac): self
    {
        $this->ac = $ac;

        return $this;
    }

    public function getCarryingcapacity(): ?string
    {
        return $this->carryingcapacity;
    }

    public function setCarryingcapacity(?string $carryingcapacity): self
    {
        $this->carryingcapacity = $carryingcapacity;

        return $this;
    }

    public function getHoldingcapacity(): ?string
    {
        return $this->holdingcapacity;
    }

    public function setHoldingcapacity(?string $holdingcapacity): self
    {
        $this->holdingcapacity = $holdingcapacity;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCostSortable(): ?float
    {
        return $this->costSortable;
    }

    public function setCostSortable(float $costSortable): self
    {
        $this->costSortable = $costSortable;

        return $this;
    }

    public function getDamage(): ?array
    {
        return $this->damage;
    }

    public function setDamage(?array $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getRecommendedlevel(): ?int
    {
        return $this->recommendedlevel;
    }

    public function setRecommendedlevel(?int $recommendedlevel): self
    {
        $this->recommendedlevel = $recommendedlevel;

        return $this;
    }

    public function getConsumable(): ?bool
    {
        return $this->consumable;
    }

    public function setConsumable(?bool $consumable): self
    {
        $this->consumable = $consumable;

        return $this;
    }

    public function getOffensebonus(): ?int
    {
        return $this->offensebonus;
    }

    public function setOffensebonus(int $offensebonus): self
    {
        $this->offensebonus = $offensebonus;

        return $this;
    }

    public function getProperties(): ?array
    {
        return $this->properties;
    }

    public function setProperties(?array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    public function getItemrange(): ?string
    {
        return $this->itemrange;
    }

    public function setItemrange(?string $itemrange): self
    {
        $this->itemrange = $itemrange;

        return $this;
    }

    public function getRarity(): ?string
    {
        return $this->rarity;
    }

    public function setRarity(?string $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(?string $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getStealth(): ?string
    {
        return $this->stealth;
    }

    public function setStealth(?string $stealth): self
    {
        $this->stealth = $stealth;

        return $this;
    }

    public function getStrengthrequirement(): ?string
    {
        return $this->strengthrequirement;
    }

    public function setStrengthrequirement(?string $strengthrequirement): self
    {
        $this->strengthrequirement = $strengthrequirement;

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(?string $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getEquipmentType(): ?string
    {
        return $this->equipmentType;
    }

    public function setEquipmentType(string $equipmentType): self
    {
        $this->equipmentType = $equipmentType;

        return $this;
    }
}
