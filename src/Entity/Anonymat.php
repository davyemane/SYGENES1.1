<?php

namespace App\Entity;

use App\Repository\AnonymatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnonymatRepository::class)]
class Anonymat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $anonymat = null;

    #[ORM\OneToOne(inversedBy: 'anonymat', cascade: ['persist', 'remove'])]
    private ?Student $student = null;


    #[ORM\ManyToOne(inversedBy: 'anonymats')]
    private ?EC $eC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnonymat(): ?string
    {
        return $this->anonymat;
    }

    public function setAnonymat(?string $anonymat): static
    {
        $this->anonymat = $anonymat;

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
