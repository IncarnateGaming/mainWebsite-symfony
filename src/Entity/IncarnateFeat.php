<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateFeatRepository")
 */
class IncarnateFeat extends IncarnateItem
{

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prerequisite;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $recommendedclasses = [];

    public function getPrerequisite(): ?string
    {
        return $this->prerequisite;
    }

    public function setPrerequisite(?string $prerequisite): self
    {
        $this->prerequisite = $prerequisite;

        return $this;
    }

    public function getRecommendedclasses(): ?array
    {
        return $this->recommendedclasses;
    }

    public function setRecommendedclasses(?array $recommendedclasses): self
    {
        $this->recommendedclasses = $recommendedclasses;

        return $this;
    }
}
