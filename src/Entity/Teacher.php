<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher
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
    private ?string $phone_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    /**
     * @var Collection<int, EC>
     */
    #[ORM\OneToMany(targetEntity: EC::class, mappedBy: 'teacher')]
    private Collection $ecs;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    
    #[ORM\OneToOne(mappedBy: 'teacher', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'teachers')]
    private ?User $created_by = null;

    /**
     * @var Collection<int, AssistantTeacher>
     */
    #[ORM\OneToMany(targetEntity: AssistantTeacher::class, mappedBy: 'teacher')]
    private Collection $assistantTeachers;

    public function __construct()
    {
        $this->ecs = new ArrayCollection();
        $this->assistantTeachers = new ArrayCollection();
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

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): static
    {
        $this->phone_number = $phone_number;

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

    /**
     * @return Collection<int, EC>
     */
    public function getEcs(): Collection
    {
        return $this->ecs;
    }

    public function addEc(EC $ec): static
    {
        if (!$this->ecs->contains($ec)) {
            $this->ecs->add($ec);
            $ec->setTeacher($this);
        }

        return $this;
    }

    public function removeEc(EC $ec): static
    {
        if ($this->ecs->removeElement($ec)) {
            // set the owning side to null (unless already changed)
            if ($ec->getTeacher() === $this) {
                $ec->setTeacher(null);
            }
        }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setTeacher(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getTeacher() !== $this) {
            $user->setTeacher($this);
        }

        $this->user = $user;

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

    /**
     * @return Collection<int, AssistantTeacher>
     */
    public function getAssistantTeachers(): Collection
    {
        return $this->assistantTeachers;
    }

    public function addAssistantTeacher(AssistantTeacher $assistantTeacher): static
    {
        if (!$this->assistantTeachers->contains($assistantTeacher)) {
            $this->assistantTeachers->add($assistantTeacher);
            $assistantTeacher->setTeacher($this);
        }

        return $this;
    }

    public function removeAssistantTeacher(AssistantTeacher $assistantTeacher): static
    {
        if ($this->assistantTeachers->removeElement($assistantTeacher)) {
            // set the owning side to null (unless already changed)
            if ($assistantTeacher->getTeacher() === $this) {
                $assistantTeacher->setTeacher(null);
            }
        }

        return $this;
    }
}
