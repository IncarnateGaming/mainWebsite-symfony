<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateBackgroundRepository")
 */
class IncarnateBackground extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featureFid;

    /**
     * @ORM\Column(type="integer", length==16)
     */
    private $gp;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $languages = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skillProficiencies;

    /**
     * @ORM\Column(type="array")
     */
    private $startingEquipment = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $toolProficiencies;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $personalityFID;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $idealFID;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $bondFID;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $flawFID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeatureFid(): ?string
    {
        return $this->featureFid;
    }

    public function setFeatureFid(string $featureFid): self
    {
        $this->featureFid = $featureFid;

        return $this;
    }

    public function getGp(): ?int
    {
        return $this->gp;
    }

    public function setGp(int $gp): self
    {
        $this->gp = $gp;

        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(?array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getSkillProficiencies(): ?string
    {
        return $this->skillProficiencies;
    }

    public function setSkillProficiencies(string $skillProficiencies): self
    {
        $this->skillProficiencies = $skillProficiencies;

        return $this;
    }

    public function getStartingEquipment(): ?array
    {
        return $this->startingEquipment;
    }

    public function setStartingEquipment(array $startingEquipment): self
    {
        $this->startingEquipment = $startingEquipment;

        return $this;
    }

    public function getToolProficiencies(): ?string
    {
        return $this->toolProficiencies;
    }

    public function setToolProficiencies(?string $toolProficiencies): self
    {
        $this->toolProficiencies = $toolProficiencies;

        return $this;
    }

    public function getPersonalityFID(): ?string
    {
        return $this->personalityFID;
    }

    public function setPersonalityFID(string $personalityFID): self
    {
        $this->personalityFID = $personalityFID;

        return $this;
    }

    public function getIdealFID(): ?string
    {
        return $this->idealFID;
    }

    public function setIdealFID(string $idealFID): self
    {
        $this->idealFID = $idealFID;

        return $this;
    }

    public function getBondFID(): ?string
    {
        return $this->bondFID;
    }

    public function setBondFID(string $bondFID): self
    {
        $this->bondFID = $bondFID;

        return $this;
    }

    public function getFlawFID(): ?string
    {
        return $this->flawFID;
    }

    public function setFlawFID(string $flawFID): self
    {
        $this->flawFID = $flawFID;

        return $this;
    }
}
