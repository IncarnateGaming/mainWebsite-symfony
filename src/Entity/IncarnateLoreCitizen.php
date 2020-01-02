<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateLoreCitizenRepository")
 */
class IncarnateLoreCitizen extends IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="array")
     */
    private $abilityScores = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $ac = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $acTotal;

    /**
     * @ORM\Column(type="array")
     */
    private $classes = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $experience = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $featList = [];

    /**
     * @ORM\Column(type="array")
     */
    private $hp = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $initiative = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $initiativeTotal;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $inventory = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $languages = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateBackground", inversedBy="incarnateLoreCitizens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $background;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personality;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ideal;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bond;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $flaw;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateRace", inversedBy="incarnateLoreCitizens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateRaceSubrace", inversedBy="incarnateLoreCitizens")
     */
    private $subrace;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $skills = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $spellcasting = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreSubpoint", inversedBy="incarnateLoreCitizens")
     */
    private $incarnateLoreSubpoint;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IncarnateLoreBuildings", inversedBy="incarnateLoreCitizens")
     */
    private $incarnateLoreBuilding;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getAbilityScores(): ?array
    {
        return $this->abilityScores;
    }

    public function setAbilityScores(array $abilityScores): self
    {
        $this->abilityScores = $abilityScores;

        return $this;
    }

    public function getAc(): ?array
    {
        return $this->ac;
    }

    public function setAc(?array $ac): self
    {
        $this->ac = $ac;

        return $this;
    }

    public function getAcTotal(): ?int
    {
        return $this->acTotal;
    }

    public function setAcTotal(int $acTotal): self
    {
        $this->acTotal = $acTotal;

        return $this;
    }

    public function getClasses(): ?array
    {
        return $this->classes;
    }

    public function setClasses(array $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getExperience(): ?array
    {
        return $this->experience;
    }

    public function setExperience(?array $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getFeatList(): ?array
    {
        return $this->featList;
    }

    public function setFeatList(?array $featList): self
    {
        $this->featList = $featList;

        return $this;
    }

    public function getHp(): ?array
    {
        return $this->hp;
    }

    public function setHp(array $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getInitiative(): ?array
    {
        return $this->initiative;
    }

    public function setInitiative(?array $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getInitiativeTotal(): ?int
    {
        return $this->initiativeTotal;
    }

    public function setInitiativeTotal(int $initiativeTotal): self
    {
        $this->initiativeTotal = $initiativeTotal;

        return $this;
    }

    public function getInventory(): ?array
    {
        return $this->inventory;
    }

    public function setInventory(?array $inventory): self
    {
        $this->inventory = $inventory;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBackground(): ?IncarnateBackground
    {
        return $this->background;
    }

    public function setBackground(?IncarnateBackground $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getPersonality(): ?string
    {
        return $this->personality;
    }

    public function setPersonality(?string $personality): self
    {
        $this->personality = $personality;

        return $this;
    }

    public function getIdeal(): ?string
    {
        return $this->ideal;
    }

    public function setIdeal(?string $ideal): self
    {
        $this->ideal = $ideal;

        return $this;
    }

    public function getBond(): ?string
    {
        return $this->bond;
    }

    public function setBond(?string $bond): self
    {
        $this->bond = $bond;

        return $this;
    }

    public function getFlaw(): ?string
    {
        return $this->flaw;
    }

    public function setFlaw(?string $flaw): self
    {
        $this->flaw = $flaw;

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

    public function getSubrace(): ?IncarnateRaceSubrace
    {
        return $this->subrace;
    }

    public function setSubrace(?IncarnateRaceSubrace $subrace): self
    {
        $this->subrace = $subrace;

        return $this;
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

    public function getSpellcasting(): ?array
    {
        return $this->spellcasting;
    }

    public function setSpellcasting(?array $spellcasting): self
    {
        $this->spellcasting = $spellcasting;

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

    public function getIncarnateLoreSubpoint(): ?IncarnateLoreSubpoint
    {
        return $this->incarnateLoreSubpoint;
    }

    public function setIncarnateLoreSubpoint(?IncarnateLoreSubpoint $incarnateLoreSubpoint): self
    {
        $this->incarnateLoreSubpoint = $incarnateLoreSubpoint;

        return $this;
    }

    public function getIncarnateLoreBuilding(): ?IncarnateLoreBuildings
    {
        return $this->incarnateLoreBuilding;
    }

    public function setIncarnateLoreBuilding(?IncarnateLoreBuildings $incarnateLoreBuilding): self
    {
        $this->incarnateLoreBuilding = $incarnateLoreBuilding;

        return $this;
    }

}
