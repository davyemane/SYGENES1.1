<?php

namespace App\Entity;

use App\Repository\RespUeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RespUeRepository::class)]
class RespUe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cni = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone_number = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?UE $ue = null;

    #[ORM\ManyToOne(inversedBy: 'respUes')]
    private ?User $created_by = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    /**
     * @var Collection<int, AssistantRespue>
     */
    #[ORM\OneToMany(targetEntity: AssistantRespue::class, mappedBy: 'Respue')]
    private Collection $assistantRespues;

    public function __construct()
    {
        $this->assistantRespues = new ArrayCollection();
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

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(?string $cni): static
    {
        $this->cni = $cni;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): static
    {
        $this->phone_number = $phone_number;

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

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): static
    {
        $this->created_by = $created_by;

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

    /**
     * @return Collection<int, AssistantRespue>
     */
    public function getAssistantRespues(): Collection
    {
        return $this->assistantRespues;
    }

    public function addAssistantRespue(AssistantRespue $assistantRespue): static
    {
        if (!$this->assistantRespues->contains($assistantRespue)) {
            $this->assistantRespues->add($assistantRespue);
            $assistantRespue->setRespue($this);
        }

        return $this;
    }

    public function removeAssistantRespue(AssistantRespue $assistantRespue): static
    {
        if ($this->assistantRespues->removeElement($assistantRespue)) {
            // set the owning side to null (unless already changed)
            if ($assistantRespue->getRespue() === $this) {
                $assistantRespue->setRespue(null);
            }
        }

        return $this;
    }
}
