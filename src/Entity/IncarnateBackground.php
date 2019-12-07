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
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $featurefid;

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
     * @ORM\Column(type="string", length=16)
     */
    private $personalityfid;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $idealfid;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $bondfid;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $flawfid;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $suggestedCharIntro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateBackgroundFeature", mappedBy="incarnateBackground")
     */
    private $incarnateBackgroundFeatures;

    public function __construct()
    {
        $this->incarnateBackgroundFeatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeaturefid(): ?string
    {
        return $this->featurefid;
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

    public function getPersonalityfid(): ?string
    {
        return $this->personalityfid;
    }

    public function setPersonalityfid(string $personalityfid): self
    {
        $this->personalityfid = $personalityfid;

        return $this;
    }

    public function getIdealfid(): ?string
    {
        return $this->idealfid;
    }

    public function setIdealfid(string $idealfid): self
    {
        $this->idealfid = $idealfid;

        return $this;
    }

    public function getBondfid(): ?string
    {
        return $this->bondfid;
    }

    public function setBondfid(string $bondfid): self
    {
        $this->bondfid = $bondfid;

        return $this;
    }

    public function getFlawfid(): ?string
    {
        return $this->flawfid;
    }

    public function setFlawfid(string $flawfid): self
    {
        $this->flawfid = $flawfid;

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
}
