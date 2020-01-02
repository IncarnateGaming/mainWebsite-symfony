<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateRaceSubraceRepository")
 */
class IncarnateRaceSubrace extends IncarnateItem
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
    private $statChanges = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $languages = [];

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
    private $nameClan;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $nameFemale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateTable")
     */
    private $nameMale;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateRaceSubraceTrait", mappedBy="subrace")
     */
    private $incarnateRaceSubraceTraits;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $darkvision;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateRace", inversedBy="subraces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IncarnateLoreCitizen", mappedBy="subrace")
     */
    private $incarnateLoreCitizens;

    public function __construct()
    {
        $this->incarnateRaceSubraceTraits = new ArrayCollection();
        $this->incarnateLoreCitizens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(?array $languages): self
    {
        $this->languages = $languages;

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

    public function getNameClan(): ?IncarnateTable
    {
        return $this->nameClan;
    }

    public function setNameClan(?IncarnateTable $nameClan): self
    {
        $this->nameClan = $nameClan;

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

    /**
     * @return Collection|IncarnateRaceSubraceTrait[]
     */
    public function getIncarnateRaceSubraceTraits(): Collection
    {
        return $this->incarnateRaceSubraceTraits;
    }

    public function addIncarnateRaceSubraceTrait(IncarnateRaceSubraceTrait $incarnateRaceSubraceTrait): self
    {
        if (!$this->incarnateRaceSubraceTraits->contains($incarnateRaceSubraceTrait)) {
            $this->incarnateRaceSubraceTraits[] = $incarnateRaceSubraceTrait;
            $incarnateRaceSubraceTrait->setSubrace($this);
        }

        return $this;
    }

    public function removeIncarnateRaceSubraceTrait(IncarnateRaceSubraceTrait $incarnateRaceSubraceTrait): self
    {
        if ($this->incarnateRaceSubraceTraits->contains($incarnateRaceSubraceTrait)) {
            $this->incarnateRaceSubraceTraits->removeElement($incarnateRaceSubraceTrait);
            // set the owning side to null (unless already changed)
            if ($incarnateRaceSubraceTrait->getSubrace() === $this) {
                $incarnateRaceSubraceTrait->setSubrace(null);
            }
        }

        return $this;
    }

    public function getDarkvision(): ?int
    {
        return $this->darkvision;
    }

    public function setDarkvision(?int $darkvision): self
    {
        $this->darkvision = $darkvision;

        return $this;
    }

    public function getRace(): ?IncarnateRace
    {
        return $this->race;
    }

    public function setRace(?IncarnateRace $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection|IncarnateLoreCitizen[]
     */
    public function getIncarnateLoreCitizens(): Collection
    {
        return $this->incarnateLoreCitizens;
    }

    public function addIncarnateLoreCitizen(IncarnateLoreCitizen $incarnateLoreCitizen): self
    {
        if (!$this->incarnateLoreCitizens->contains($incarnateLoreCitizen)) {
            $this->incarnateLoreCitizens[] = $incarnateLoreCitizen;
            $incarnateLoreCitizen->setSubrace($this);
        }

        return $this;
    }

    public function removeIncarnateLoreCitizen(IncarnateLoreCitizen $incarnateLoreCitizen): self
    {
        if ($this->incarnateLoreCitizens->contains($incarnateLoreCitizen)) {
            $this->incarnateLoreCitizens->removeElement($incarnateLoreCitizen);
            // set the owning side to null (unless already changed)
            if ($incarnateLoreCitizen->getSubrace() === $this) {
                $incarnateLoreCitizen->setSubrace(null);
            }
        }

        return $this;
    }
}
