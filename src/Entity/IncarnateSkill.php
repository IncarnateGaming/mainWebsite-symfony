<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateSkillRepository")
 */
class IncarnateSkill extends IncarnateItem
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
    private $ability;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skillType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbility(): ?string
    {
        return $this->ability;
    }

    public function setAbility(string $ability): self
    {
        $this->ability = $ability;

        return $this;
    }

    public function getSkillType(): ?string
    {
        return $this->skillType;
    }

    public function setSkillType(?string $skillType): self
    {
        $this->skillType = $skillType;

        return $this;
    }
}
