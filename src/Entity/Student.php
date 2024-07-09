<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $studentID = null;

    #[Assert\Length(min:3,minMessage:"veuillez avoir au moins 4 caractere")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'students', targetEntity:Field::class)]
    private $field = null;

    #[ORM\ManyToOne(inversedBy: 'students', targetEntity:Level::class)]
    private $level = null;

    /**
     * @var Collection<int, TakeUe>
     */
    #[ORM\OneToMany(targetEntity: TakeUe::class, mappedBy: 'student')]
    private Collection $takeUes;

    #[Assert\Email(message:'veuillez entrer un email corect!')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $placeOfBirth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthCertificate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $admissionCertificate = null;

    #[ORM\OneToOne(mappedBy: 'student', cascade: ['persist', 'remove'])]
    private ?User $userAccount = null;

    /**
     * @var Collection<int, Note>
     */
    #[ORM\OneToMany(targetEntity: Note::class, mappedBy: 'student')]
    private Collection $notes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cni = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    public function __construct()
    {
        $this->takeUes = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->notescctps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentID(): ?string
    {
        return $this->studentID;
    }

    public function setStudentID(?string $studentID): static
    {
        $this->studentID = $studentID;

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

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, TakeUe>
     */
    public function getTakeUes(): Collection
    {
        return $this->takeUes;
    }

    public function addTakeUe(TakeUe $takeUe): static
    {
        if (!$this->takeUes->contains($takeUe)) {
            $this->takeUes->add($takeUe);
            $takeUe->setStudent($this);
        }

        return $this;
    }

    public function removeTakeUe(TakeUe $takeUe): static
    {
        if ($this->takeUes->removeElement($takeUe)) {
            // set the owning side to null (unless already changed)
            if ($takeUe->getStudent() === $this) {
                $takeUe->setStudent(null);
            }
        }

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
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): static
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getBirthCertificate(): ?string
    {
        return $this->birthCertificate;
    }

    public function setBirthCertificate(?string $birthCertificate): static
    {
        $this->birthCertificate = $birthCertificate;

        return $this;
    }

    public function getAdmissionCertificate(): ?string
    {
        return $this->admissionCertificate;
    }

    public function setAdmissionCertificate(?string $admissionCertificate): static
    {
        $this->admissionCertificate = $admissionCertificate;

        return $this;
    }

    public function __toString():string
    {
        return $this->name;
    }

    public function getUserAccount(): ?User
    {
        return $this->userAccount;
    }

    public function setUserAccount(?User $userAccount): static
    {
        // unset the owning side of the relation if necessary
        if ($userAccount === null && $this->userAccount !== null) {
            $this->userAccount->setStudent(null);
        }

        // set the owning side of the relation if necessary
        if ($userAccount !== null && $userAccount->getStudent() !== $this) {
            $userAccount->setStudent($this);
        }

        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): static
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setStudent($this);
        }

        return $this;
    }

    public function removeNote(Note $note): static
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getStudent() === $this) {
                $note->setStudent(null);
            }
        }

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): static
    {
        $this->sexe = $sexe;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    private $fullGrades;

    /**
     * @var Collection<int, NoteCcTp>
     */
    #[ORM\OneToMany(targetEntity: NoteCcTp::class, mappedBy: 'student')]
    private Collection $notescctps;

    #[ORM\OneToOne(mappedBy: 'student', cascade: ['persist', 'remove'])]
    private ?Anonymat $anonymat = null;


    public function setFullGrades(array $fullGrades): self
    {
        $this->fullGrades = $fullGrades;
        return $this;
    }

    public function getFullGrades(): ?array
    {
        return $this->fullGrades;
    }

    /**
     * @return Collection<int, NoteCcTp>
     */
    public function getNotescctps(): Collection
    {
        return $this->notescctps;
    }

    public function addNotescctp(NoteCcTp $notescctp): static
    {
        if (!$this->notescctps->contains($notescctp)) {
            $this->notescctps->add($notescctp);
            $notescctp->setStudent($this);
        }

        return $this;
    }

    public function removeNotescctp(NoteCcTp $notescctp): static
    {
        if ($this->notescctps->removeElement($notescctp)) {
            // set the owning side to null (unless already changed)
            if ($notescctp->getStudent() === $this) {
                $notescctp->setStudent(null);
            }
        }

        return $this;
    }

    public function getAnonymat(): ?Anonymat
    {
        return $this->anonymat;
    }

    public function setAnonymat(?Anonymat $anonymat): static
    {
        // unset the owning side of the relation if necessary
        if ($anonymat === null && $this->anonymat !== null) {
            $this->anonymat->setStudent(null);
        }

        // set the owning side of the relation if necessary
        if ($anonymat !== null && $anonymat->getStudent() !== $this) {
            $anonymat->setStudent($this);
        }

        $this->anonymat = $anonymat;

        return $this;
    }


}
