<?php

namespace App\Entity;

use App\Repository\ECRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ECRepository::class)]
class EC
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeEc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'eCs')]
    private ?UE $ue = null;

    #[ORM\Column(nullable: true)]
    private ?string $credit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeEc(): ?string
    {
        return $this->codeEc;
    }

    public function setCodeEc(?string $codeEc): static
    {
        $this->codeEc = $codeEc;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUe(): ?UE
    {
        return $this->ue;
    }

    public function setUe(?UE $ue): static
    {
        $this->ue = $ue;

        return $this;
    }

    public function __toString():string
    {
        return $this->name;
    }

    public function getCredit(): ?string
    {
        return $this->credit;
    }

    public function setCredit(?string $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

}
