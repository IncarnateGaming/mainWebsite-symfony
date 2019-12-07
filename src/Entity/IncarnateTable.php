<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncarnateTableRepository")
 */
class IncarnateTable extends IncarnateItem
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
    private $columnNames = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dicemodifier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dicetoroll;

    /**
     * @ORM\Column(type="array")
     */
    private $tr = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColumnNames(): ?array
    {
        return $this->columnNames;
    }

    public function setColumnNames(?array $columnNames): self
    {
        $this->columnNames = $columnNames;

        return $this;
    }

    public function getDicemodifier(): ?int
    {
        return $this->dicemodifier;
    }

    public function setDicemodifier(?int $dicemodifier): self
    {
        $this->dicemodifier = $dicemodifier;

        return $this;
    }

    public function getDicetoroll(): ?string
    {
        return $this->dicetoroll;
    }

    public function setDicetoroll(?string $dicetoroll): self
    {
        $this->dicetoroll = $dicetoroll;

        return $this;
    }

    public function getTr(): ?array
    {
        return $this->tr;
    }

    public function setTr(array $tr): self
    {
        $this->tr = $tr;

        return $this;
    }
}
