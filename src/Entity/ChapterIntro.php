<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChapterIntroRepository")
 */
class ChapterIntro extends IncarnateItem
{
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $template;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $simpleName;

    public function getTemplate(): ?bool
    {
        return $this->template;
    }

    public function setTemplate(?bool $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getSimpleName(): ?string
    {
        return $this->simpleName;
    }

    public function setSimpleName(?string $simpleName): self
    {
        $this->simpleName = $simpleName;

        return $this;
    }
}
