<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateClassTraitRepository")
 */
class IncarnateClassTrait extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $specializationChoice;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateClass", inversedBy="incarnateClassTraits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incarnateClass;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecializationChoice(): ?bool
    {
        return $this->specializationChoice;
    }

    public function setSpecializationChoice(?bool $specializationChoice): self
    {
        $this->specializationChoice = $specializationChoice;

        return $this;
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

    public function getIncarnateClass(): ?IncarnateClass
    {
        return $this->incarnateClass;
    }

    public function setIncarnateClass(?IncarnateClass $incarnateClass): self
    {
        $this->incarnateClass = $incarnateClass;

        return $this;
    }
}
