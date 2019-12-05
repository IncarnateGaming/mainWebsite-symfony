<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateBackgroundFeatureRepository")
 */
class IncarnateBackgroundFeature extends IncarnateItem
{
    /**
     * @ORM\Column(type="string", length=16)
     */
    private $parentfid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parentname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentfid(): ?string
    {
        return $this->parentfid;
    }

    public function setParentfid(string $parentfid): self
    {
        $this->parentfid = $parentfid;

        return $this;
    }

    public function getParentname(): ?string
    {
        return $this->parentname;
    }

    public function setParentname(string $parentname): self
    {
        $this->parentname = $parentname;

        return $this;
    }
}
