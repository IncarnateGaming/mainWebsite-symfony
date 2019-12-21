<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateItemRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="item_type",type="string")
 * @ORM\DiscriminatorMap({"chapterintro"="ChapterIntro",
 *     "background"="IncarnateBackground",
 *     "background_feature"="IncarnateBackgroundFeature",
 *     "class"="IncarnateClass",
 *     "class_archetype"="IncarnateClassArchetype",
 *     "class_archetype_trait"="IncarnateClassArchetypeTrait",
 *     "class_trait"="IncarnateClassTrait",
 *     "equipment"="IncarnateEquipment",
 *     "equipment_pack"="IncarnateEquipmentPack",
 *     "feat"="IncarnateFeat",
 *     "item"="IncarnateItem",
 *     "riddle"="IncarnateRiddle",
 *     "race"="IncarnateRace",
 *     "race_subrace"="IncarnateRaceSubrace",
 *     "race_trait"="IncarnateRaceTrait",
 *     "race_subrace_trait"="IncarnateRaceSubraceTrait",
 *     "skill"="IncarnateSkill",
 *     "table"="IncarnateTable"})
 */
class IncarnateItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $fid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ugfid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $official;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $legal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFid(): ?string
    {
        return $this->fid;
    }

    public function setFid(string $fid): self
    {
        $this->fid = $fid;

        return $this;
    }

    public function getUgfid(): ?string
    {
        return $this->ugfid;
    }

    public function setUgfid(string $ugfid): self
    {
        $this->ugfid = $ugfid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getOfficial(): ?string
    {
        return $this->official;
    }

    public function setOfficial(string $official): self
    {
        $this->official = $official;

        return $this;
    }

    public function getLegal(): ?string
    {
        return $this->legal;
    }

    public function setLegal(?string $legal): self
    {
        $this->legal = $legal;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
