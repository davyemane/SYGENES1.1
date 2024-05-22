<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rattrapage = null;

    #[ORM\ManyToOne]
    private ?User $createb_by = null;

    #[ORM\Column(nullable: true)]
    private ?string $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?Student $student = null;

    #[ORM\ManyToOne]
    private ?EC $ec = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $semester = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCc(): ?string
    {
        return $this->cc;
    }

    public function setCc(?string $cc): static
    {
        $this->cc = $cc;

        return $this;
    }

    public function getTp(): ?string
    {
        return $this->tp;
    }

    public function setTp(?string $tp): static
    {
        $this->tp = $tp;

        return $this;
    }

    public function getSn(): ?string
    {
        return $this->sn;
    }

    public function setSn(?string $sn): static
    {
        $this->sn = $sn;

        return $this;
    }

    public function getRattrapage(): ?string
    {
        return $this->rattrapage;
    }

    public function setRattrapage(?string $rattrapage): static
    {
        $this->rattrapage = $rattrapage;

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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): static
    {
        $this->created_at = $created_at;

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

    public function getEc(): ?EC
    {
        return $this->ec;
    }

    public function setEc(?EC $ec): static
    {
        $this->ec = $ec;

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
}
