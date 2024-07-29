<?php

namespace App\Entity;

use App\Repository\AssistantTeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssistantTeacherRepository::class)]
class AssistantTeacher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cni = null;

    #[ORM\ManyToOne(inversedBy: 'assistantTeachers')]
    private ?Teacher $teacher = null;

    #[ORM\OneToOne(inversedBy: 'assistantTeacher', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'assistantTeacher')]
    private Collection $created_by;

    public function __construct()
    {
        $this->created_by = new ArrayCollection();
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): static
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
     * @return Collection<int, User>
     */
    public function getCreatedBy(): Collection
    {
        return $this->created_by;
    }

    public function addCreatedBy(User $createdBy): static
    {
        if (!$this->created_by->contains($createdBy)) {
            $this->created_by->add($createdBy);
            $createdBy->setAssistantTeacher($this);
        }

        return $this;
    }

    public function removeCreatedBy(User $createdBy): static
    {
        if ($this->created_by->removeElement($createdBy)) {
            // set the owning side to null (unless already changed)
            if ($createdBy->getAssistantTeacher() === $this) {
                $createdBy->setAssistantTeacher(null);
            }
        }

        return $this;
    }
}
