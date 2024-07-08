<?php

namespace App\Entity;

use App\Repository\NoteCcTpRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteCcTpRepository::class)]
class NoteCcTp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $cc = null;

    #[ORM\Column(nullable: true)]
    private ?float $tp = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasTp = null;

    #[ORM\ManyToOne(inversedBy: 'noteCcTps')]
    private ?EC $eC = null;

    #[ORM\OneToOne(inversedBy: 'noteCcTp', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\ManyToOne(inversedBy: 'noteCcTps')]
    private ?User $createb_by = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCc(): ?float
    {
        return $this->cc;
    }

    public function setCc(?float $cc): static
    {
        $this->cc = $cc;

        return $this;
    }

    public function getTp(): ?float
    {
        return $this->tp;
    }

    public function setTp(?float $tp): static
    {
        $this->tp = $tp;

        return $this;
    }

    public function hasTp(): ?bool
    {
        return $this->hasTp;
    }

    public function setHasTp(?bool $hasTp): static
    {
        $this->hasTp = $hasTp;

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

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getCreatebBy(): ?User
    {
        return $this->createb_by;
    }

    public function setCreatebBy(?User $createb_by): static
    {
        $this->createb_by = $createb_by;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
