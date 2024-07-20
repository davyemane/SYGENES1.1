<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'level', orphanRemoval: true)]
    private Collection $students;

    #[ORM\OneToMany(targetEntity: UE::class, mappedBy: 'level', orphanRemoval: true)]
    private Collection $ues;

    #[ORM\ManyToOne(inversedBy: 'levels')]
    private ?Field $field = null;

    #[ORM\OneToOne(mappedBy: 'level', cascade: ['persist', 'remove'])]
    private ?RespLevel $respLevel = null;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setLevel($this);
        }
        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            if ($student->getLevel() === $this) {
                $student->setLevel(null);
            }
        }
        return $this;
    }

    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): static
    {
        if (!$this->ues->contains($ue)) {
            $this->ues->add($ue);
            $ue->setLevel($this);
        }
        return $this;
    }

    public function removeUe(UE $ue): static
    {
        if ($this->ues->removeElement($ue)) {
            if ($ue->getLevel() === $this) {
                $ue->setLevel(null);
            }
        }
        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): static
    {
        $this->field = $field;
        return $this;
    }

    public function getRespLevel(): ?RespLevel
    {
        return $this->respLevel;
    }

    public function setRespLevel(?RespLevel $respLevel): self
    {
        if ($respLevel === null && $this->respLevel !== null) {
            $this->respLevel->setLevel(null);
        }

        if ($respLevel !== null && $respLevel->getLevel() !== $this) {
            $respLevel->setLevel($this);
        }

        $this->respLevel = $respLevel;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    public function remove(): void
    {
        // Supprimer tous les étudiants associés
        foreach ($this->students as $student) {
            $this->removeStudent($student);
        }

        // Supprimer toutes les UEs associées
        foreach ($this->ues as $ue) {
            $this->removeUe($ue);
        }

        // Dissocier le champ (Field)
        if ($this->field !== null) {
            $this->field->removeLevel($this);
            $this->field = null;
        }

        // Supprimer le RespLevel associé
        if ($this->respLevel !== null) {
            $this->respLevel->setLevel(null);
            $this->respLevel = null;
        }
    }
}