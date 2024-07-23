<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UERepository::class)]
class UE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeUe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $credit = null;

    /**
     * @var Collection<int, EC>
     */
    #[ORM\OneToMany(targetEntity: EC::class, mappedBy: 'ue')]
    private Collection $eCs;

    /**
     * @var Collection<int, Level>
     */

    #[ORM\ManyToOne(inversedBy: 'ues')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?Level $level = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $semester = null;

    #[ORM\Column(nullable: true)]
    private ?float $grade = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $academicYear = null;

    /**
     * @var Collection<int, Field>
     */
    #[ORM\ManyToMany(targetEntity: Field::class, inversedBy: 'uEs')]
    #[ORM\JoinTable(name: 'ue_field')]
    private Collection $fields;

    public function __construct()
    {
        $this->eCs = new ArrayCollection();
        $this->fields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeUe(): ?string
    {
        return $this->codeUe;
    }

    public function setCodeUe(?string $codeUe): static
    {
        $this->codeUe = $codeUe;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(?int $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @return Collection<int, EC>
     */
    public function getECs(): Collection
    {
        return $this->eCs;
    }

    public function addEC(EC $eC): static
    {
        if (!$this->eCs->contains($eC)) {
            $this->eCs->add($eC);
            $eC->setUe($this);
        }

        return $this;
    }

    public function removeEC(EC $eC): static
    {
        if ($this->eCs->removeElement($eC)) {
            if ($eC->getUe() === $this) {
                $eC->setUe(null);
            }
        }

        return $this;
    }


    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSemester(): ?string
    {
        return $this->semester;
    }

    public function setSemester(?string $semester): static
    {
        $this->semester = $semester;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getGrade(): ?float
    {
        return $this->grade;
    }

    public function setGrade(?float $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getAcademicYear(): ?string
    {
        return $this->academicYear;
    }

    public function setAcademicYear(?string $academicYear): static
    {
        $this->academicYear = $academicYear;

        return $this;
    }

 /**
     * @return Collection<int, Field>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(Field $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
            $field->addUE($this);
        }
        return $this;
    }
    
    public function removeField(Field $field): self
    {
        if ($this->fields->removeElement($field)) {
            $field->removeUE($this);
        }

        return $this;
    }

    public function removeLevel(Level $level): static
    {
        if ($this->level === $level) {
            $this->level = null;
        }

        return $this;
    }
}
