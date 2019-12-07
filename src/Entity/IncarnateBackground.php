<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="integer")
     */
    private $gp;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $languages = [];

    /**
     * @ORM\Column(type="array")
     */
    private $skillProf = [];

    /**
     * @ORM\Column(type="array")
     */
    private $startEq = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $toolProf = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $suggestedCharIntro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateBackgroundFeature", mappedBy="incarnateBackground")
     */
    private $incarnateBackgroundFeatures;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $personality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $ideal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $bond;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $flaw;

    public function __construct()
    {
        $this->incarnateBackgroundFeatures = new ArrayCollection();
        $this->personality = new ArrayCollection();
        $this->ideal = new ArrayCollection();
        $this->bond = new ArrayCollection();
        $this->flaw = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFeaturefid(?string $featurefid): self
    {
        $this->featurefid = $featurefid;

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

    public function getSkillProf(): ?array
    {
        return $this->skillProf;
    }

    public function setSkillProf(array $skillProf): self
    {
        $this->skillProf = $skillProf;

        return $this;
    }

    public function getStartEq(): ?array
    {
        return $this->startEq;
    }

    public function setStartEq(array $startEq): self
    {
        $this->startEq = $startEq;

        return $this;
    }

    public function getToolProf(): ?array
    {
        return $this->toolProf;
    }

    public function setToolProf(?array $toolProf): self
    {
        $this->toolProf = $toolProf;

        return $this;
    }

    public function getSuggestedCharIntro(): ?string
    {
        return $this->suggestedCharIntro;
    }

    public function setSuggestedCharIntro(?string $suggestedCharIntro): self
    {
        $this->suggestedCharIntro = $suggestedCharIntro;

        return $this;
    }

    /**
     * @return Collection|IncarnateBackgroundFeature[]
     */
    public function getIncarnateBackgroundFeatures(): Collection
    {
        return $this->incarnateBackgroundFeatures;
    }

    public function addIncarnateBackgroundFeature(IncarnateBackgroundFeature $incarnateBackgroundFeature): self
    {
        if (!$this->incarnateBackgroundFeatures->contains($incarnateBackgroundFeature)) {
            $this->incarnateBackgroundFeatures[] = $incarnateBackgroundFeature;
            $incarnateBackgroundFeature->setIncarnateBackground($this);
        }

        return $this;
    }

    public function removeIncarnateBackgroundFeature(IncarnateBackgroundFeature $incarnateBackgroundFeature): self
    {
        if ($this->incarnateBackgroundFeatures->contains($incarnateBackgroundFeature)) {
            $this->incarnateBackgroundFeatures->removeElement($incarnateBackgroundFeature);
            // set the owning side to null (unless already changed)
            if ($incarnateBackgroundFeature->getIncarnateBackground() === $this) {
                $incarnateBackgroundFeature->setIncarnateBackground(null);
            }
        }

        return $this;
    }

    public function getPersonality(): ?IncarnateTable
    {
        return $this->personality;
    }

    public function setPersonality(?IncarnateTable $personality): self
    {
        $this->personality = $personality;

        return $this;
    }

    public function getIdeal(): ?IncarnateTable
    {
        return $this->ideal;
    }

    public function setIdeal(?IncarnateTable $ideal): self
    {
        $this->ideal = $ideal;

        return $this;
    }

    public function getBond(): ?IncarnateTable
    {
        return $this->bond;
    }

    public function setBond(?IncarnateTable $bond): self
    {
        $this->bond = $bond;

        return $this;
    }

    public function getFlaw(): ?IncarnateTable
    {
        return $this->flaw;
    }

    public function setFlaw(?IncarnateTable $flaw): self
    {
        $this->flaw = $flaw;

        return $this;
    }

}
