<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IncarnateEquipmentPackRepository")
 */
class IncarnateEquipmentPack extends IncarnateItem
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
    private $includeditems = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $includedmonies = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $packtype;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIncludeditems(): ?array
    {
        return $this->includeditems;
    }

    public function setIncludeditems(?array $includeditems): self
    {
        $this->includeditems = $includeditems;

        return $this;
    }

    public function getIncludedmonies(): ?array
    {
        return $this->includedmonies;
    }

    public function setIncludedmonies(?array $includedmonies): self
    {
        $this->includedmonies = $includedmonies;

        return $this;
    }

    public function getPacktype(): ?string
    {
        return $this->packtype;
    }

    public function setPacktype(?string $packtype): self
    {
        $this->packtype = $packtype;

        return $this;
    }
}
