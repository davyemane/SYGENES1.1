<?php

namespace App\Entity;

use App\Repository\AnonymatRattrapageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnonymatRattrapageRepository::class)]
class AnonymatRattrapage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeAnonymat = null;

    #[ORM\OneToOne(inversedBy: 'anonymatRattrapage', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\ManyToOne(inversedBy: 'anonymatsRattrapage')]
    private ?EC $eC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeAnonymat(): ?string
    {
        return $this->codeAnonymat;
    }

    public function setCodeAnonymat(?string $codeAnonymat): static
    {
        $this->codeAnonymat = $codeAnonymat;

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

    public function getEC(): ?EC
    {
        return $this->eC;
    }

    public function setEC(?EC $eC): static
    {
        $this->eC = $eC;

        return $this;
    }
}