<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToOne(inversedBy: 'userAccount', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;


    /**
     * @var Collection<int, NoteCcTp>
     */
    #[ORM\OneToMany(targetEntity: NoteCcTp::class, mappedBy: 'createb_by')]
    private Collection $noteCcTps;

    /**
     * @var Collection<int, EE>
     */
    #[ORM\OneToMany(targetEntity: EE::class, mappedBy: 'createdBy')]
    private Collection $eEs;

    /**
     * @var Collection<int, RespSchool>
     */
    #[ORM\OneToMany(targetEntity: RespSchool::class, mappedBy: 'created_by')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private Collection $respSchools;

    /**
     * @var Collection<int, RespField>
     */
    #[ORM\OneToMany(targetEntity: RespField::class, mappedBy: 'created_by')]
    private Collection $respFields;

    /**
     * @var Collection<int, RespLevel>
     */
    #[ORM\OneToMany(targetEntity: RespLevel::class, mappedBy: 'created_by')]
    private Collection $respLevels;

    /**
     * @var Collection<int, RespUe>
     */
    #[ORM\OneToMany(targetEntity: RespUe::class, mappedBy: 'created_by')]
    private Collection $respUes;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?RespField $respfield = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?RespSchool $respschool = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?RespLevel $resplevel = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?RespUe $respue = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Teacher $teacher = null;

    /**
     * @var Collection<int, Teacher>
     */
    #[ORM\OneToMany(targetEntity: Teacher::class, mappedBy: 'created_by')]
    private Collection $teachers;

    public function __construct()
    {
        $this->noteCcTps = new ArrayCollection();
        $this->eEs = new ArrayCollection();
        $this->respSchools = new ArrayCollection();
        $this->respFields = new ArrayCollection();
        $this->respLevels = new ArrayCollection();
        $this->respUes = new ArrayCollection();
        $this->teachers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function __toString(): string
    {
        return $this->username;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }


    /**
     * @return Collection<int, NoteCcTp>
     */
    public function getNoteCcTps(): Collection
    {
        return $this->noteCcTps;
    }

    public function addNoteCcTp(NoteCcTp $noteCcTp): static
    {
        if (!$this->noteCcTps->contains($noteCcTp)) {
            $this->noteCcTps->add($noteCcTp);
            $noteCcTp->setCreatebBy($this);
        }

        return $this;
    }

    public function removeNoteCcTp(NoteCcTp $noteCcTp): static
    {
        if ($this->noteCcTps->removeElement($noteCcTp)) {
            // set the owning side to null (unless already changed)
            if ($noteCcTp->getCreatebBy() === $this) {
                $noteCcTp->setCreatebBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EE>
     */
    public function getEEs(): Collection
    {
        return $this->eEs;
    }

    public function addEE(EE $eE): static
    {
        if (!$this->eEs->contains($eE)) {
            $this->eEs->add($eE);
            $eE->setCreatedBy($this);
        }

        return $this;
    }

    public function removeEE(EE $eE): static
    {
        if ($this->eEs->removeElement($eE)) {
            // set the owning side to null (unless already changed)
            if ($eE->getCreatedBy() === $this) {
                $eE->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RespSchool>
     */
    public function getRespSchools(): Collection
    {
        return $this->respSchools;
    }

    public function addRespSchool(RespSchool $respSchool): static
    {
        if (!$this->respSchools->contains($respSchool)) {
            $this->respSchools->add($respSchool);
            $respSchool->setCreatedBy($this);
        }

        return $this;
    }

    public function removeRespSchool(RespSchool $respSchool): static
    {
        if ($this->respSchools->removeElement($respSchool)) {
            // set the owning side to null (unless already changed)
            if ($respSchool->getCreatedBy() === $this) {
                $respSchool->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RespField>
     */
    public function getRespFields(): Collection
    {
        return $this->respFields;
    }

    public function addRespField(RespField $respField): static
    {
        if (!$this->respFields->contains($respField)) {
            $this->respFields->add($respField);
            $respField->setCreatedBy($this);
        }

        return $this;
    }

    public function removeRespField(RespField $respField): static
    {
        if ($this->respFields->removeElement($respField)) {
            // set the owning side to null (unless already changed)
            if ($respField->getCreatedBy() === $this) {
                $respField->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RespLevel>
     */
    public function getRespLevels(): Collection
    {
        return $this->respLevels;
    }

    public function addRespLevel(RespLevel $respLevel): self
    {
        if (!$this->respLevels->contains($respLevel)) {
            $this->respLevels[] = $respLevel;
            $respLevel->setCreatedBy($this);
        }
    
        return $this;
    }
    
    public function removeRespLevel(RespLevel $respLevel): self
    {
        if ($this->respLevels->removeElement($respLevel)) {
            if ($respLevel->getCreatedBy() === $this) {
                $respLevel->setCreatedBy(null);
            }
        }
    
        return $this;
    }
    
    /**
     * @return Collection<int, RespUe>
     */
    public function getRespUes(): Collection
    {
        return $this->respUes;
    }

    public function addRespUe(RespUe $respUe): static
    {
        if (!$this->respUes->contains($respUe)) {
            $this->respUes->add($respUe);
            $respUe->setCreatedBy($this);
        }

        return $this;
    }

    public function removeRespUe(RespUe $respUe): static
    {
        if ($this->respUes->removeElement($respUe)) {
            // set the owning side to null (unless already changed)
            if ($respUe->getCreatedBy() === $this) {
                $respUe->setCreatedBy(null);
            }
        }

        return $this;
    }

    public function getRespfield(): ?RespField
    {
        return $this->respfield;
    }

    public function setRespfield(?RespField $respfield): static
    {
        $this->respfield = $respfield;

        return $this;
    }

    public function getRespschool(): ?RespSchool
    {
        return $this->respschool;
    }

    public function setRespschool(?RespSchool $respschool): static
    {
        $this->respschool = $respschool;

        return $this;
    }

    public function getResplevel(): ?RespLevel
    {
        return $this->resplevel;
    }

    public function setResplevel(?RespLevel $resplevel): static
    {
        $this->resplevel = $resplevel;

        return $this;
    }

    public function getRespue(): ?RespUe
    {
        return $this->respue;
    }

    public function setRespue(?RespUe $respue): static
    {
        $this->respue = $respue;

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

    /**
     * @return Collection<int, Teacher>
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): static
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers->add($teacher);
            $teacher->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): static
    {
        if ($this->teachers->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getCreatedBy() === $this) {
                $teacher->setCreatedBy(null);
            }
        }

        return $this;
    }
}
