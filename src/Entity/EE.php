<?php

namespace App\Entity;

use App\Repository\EERepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EERepository::class)]
class EE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $mark = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $grade = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'eEs')]
    private ?User $createdBy = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Anonymat $anonymat = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?float
    {
        return $this->mark;
    }

    public function setMark(?float $mark): static
    {
        $this->mark = $mark;

        return $this;
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


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getAnonymat(): ?Anonymat
    {
        return $this->anonymat;
    }

    public function setAnonymat(?Anonymat $anonymat): static
    {
        $this->anonymat = $anonymat;

        return $this;
    }


}
