<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateRaceRepository")
 */
class IncarnateRace extends IncarnateItem
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
    private $skills = [];

    /**
     * @ORM\Column(type="array")
     */
    private $languages = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $charateristicsDescription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $personality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $bond;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $ideal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $flaw;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $descriptionFemale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $descriptionMale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $imageFemale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $imageMale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $nameFemale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $nameMale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $nameClan;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $statChanges = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateRaceTrait", mappedBy="race")
     */
    private $incarnateRaceTraits;

    /**
     * @ORM\Column(type="integer")
     */
    private $darkvision;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateRaceSubrace", mappedBy="race")
     */
    private $subraces;

    public function __construct()
    {
        $this->incarnateRaceTraits = new ArrayCollection();
        $this->subraces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkills(): ?array
    {
        return $this->skills;
    }

    public function setSkills(?array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getCharateristicsDescription(): ?string
    {
        return $this->charateristicsDescription;
    }

    public function setCharateristicsDescription(?string $charateristicsDescription): self
    {
        $this->charateristicsDescription = $charateristicsDescription;

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

    public function getBond(): ?IncarnateTable
    {
        return $this->bond;
    }

    public function setBond(?IncarnateTable $bond): self
    {
        $this->bond = $bond;

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

    public function getFlaw(): ?IncarnateTable
    {
        return $this->flaw;
    }

    public function setFlaw(?IncarnateTable $flaw): self
    {
        $this->flaw = $flaw;

        return $this;
    }

    public function getDescriptionFemale(): ?IncarnateTable
    {
        return $this->descriptionFemale;
    }

    public function setDescriptionFemale(?IncarnateTable $descriptionFemale): self
    {
        $this->descriptionFemale = $descriptionFemale;

        return $this;
    }

    public function getDescriptionMale(): ?IncarnateTable
    {
        return $this->descriptionMale;
    }

    public function setDescriptionMale(?IncarnateTable $descriptionMale): self
    {
        $this->descriptionMale = $descriptionMale;

        return $this;
    }

    public function getImageFemale(): ?IncarnateTable
    {
        return $this->imageFemale;
    }

    public function setImageFemale(?IncarnateTable $imageFemale): self
    {
        $this->imageFemale = $imageFemale;

        return $this;
    }

    public function getImageMale(): ?IncarnateTable
    {
        return $this->imageMale;
    }

    public function setImageMale(?IncarnateTable $imageMale): self
    {
        $this->imageMale = $imageMale;

        return $this;
    }

    public function getNameFemale(): ?IncarnateTable
    {
        return $this->nameFemale;
    }

    public function setNameFemale(?IncarnateTable $nameFemale): self
    {
        $this->nameFemale = $nameFemale;

        return $this;
    }

    public function getNameMale(): ?IncarnateTable
    {
        return $this->nameMale;
    }

    public function setNameMale(?IncarnateTable $nameMale): self
    {
        $this->nameMale = $nameMale;

        return $this;
    }

    public function getNameClan(): ?IncarnateTable
    {
        return $this->nameClan;
    }

    public function setNameClan(?IncarnateTable $nameClan): self
    {
        $this->nameClan = $nameClan;

        return $this;
    }

    public function getStatChanges(): ?array
    {
        return $this->statChanges;
    }

    public function setStatChanges(?array $statChanges): self
    {
        $this->statChanges = $statChanges;

        return $this;
    }

    /**
     * @return Collection|IncarnateRaceTrait[]
     */
    public function getIncarnateRaceTraits(): Collection
    {
        return $this->incarnateRaceTraits;
    }

    public function addIncarnateRaceTrait(IncarnateRaceTrait $incarnateRaceTrait): self
    {
        if (!$this->incarnateRaceTraits->contains($incarnateRaceTrait)) {
            $this->incarnateRaceTraits[] = $incarnateRaceTrait;
            $incarnateRaceTrait->setRace($this);
        }

        return $this;
    }

    public function removeIncarnateRaceTrait(IncarnateRaceTrait $incarnateRaceTrait): self
    {
        if ($this->incarnateRaceTraits->contains($incarnateRaceTrait)) {
            $this->incarnateRaceTraits->removeElement($incarnateRaceTrait);
            // set the owning side to null (unless already changed)
            if ($incarnateRaceTrait->getRace() === $this) {
                $incarnateRaceTrait->setRace(null);
            }
        }

        return $this;
    }

    public function getDarkvision(): ?int
    {
        return $this->darkvision;
    }

    public function setDarkvision(int $darkvision): self
    {
        $this->darkvision = $darkvision;

        return $this;
    }

    /**
     * @return Collection|IncarnateRaceSubrace[]
     */
    public function getSubraces(): Collection
    {
        return $this->subraces;
    }

    public function addSubrace(IncarnateRaceSubrace $subrace): self
    {
        if (!$this->subraces->contains($subrace)) {
            $this->subraces[] = $subrace;
            $subrace->setRace($this);
        }

        return $this;
    }

    public function removeSubrace(IncarnateRaceSubrace $subrace): self
    {
        if ($this->subraces->contains($subrace)) {
            $this->subraces->removeElement($subrace);
            // set the owning side to null (unless already changed)
            if ($subrace->getRace() === $this) {
                $subrace->setRace(null);
            }
        }

        return $this;
    }
}
