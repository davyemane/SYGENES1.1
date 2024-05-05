<?php

namespace App\Entity;

use App\Repository\TakeUeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TakeUeRepository::class)]
class TakeUe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $grade = null;

    #[ORM\Column(nullable: true)]
    private ?int $semester = null;

    #[ORM\ManyToOne(inversedBy: 'takeUes')]
    private ?Student $student = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getSemester(): ?int
    {
        return $this->semester;
    }

    public function setSemester(?int $semester): static
    {
        $this->semester = $semester;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getUe(): ?string
    {
        return $this->ue;
    }

    public function setUe(?string $ue): static
    {
        $this->ue = $ue;

        return $this;
    }
}
