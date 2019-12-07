<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChapterIntroRepository")
 */
class ChapterIntro extends IncarnateItem
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
    private $template;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $simpleName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $categoryFid;

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCategoryFid(): ?string
    {
        return $this->categoryFid;
    }

    public function setCategoryFid(?string $categoryFid): self
    {
        $this->categoryFid = $categoryFid;

        return $this;
    }
}
