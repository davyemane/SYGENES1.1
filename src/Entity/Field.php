<?php

namespace App\Entity;

use App\Repository\FieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldRepository::class)]
class Field
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'field')]
    private Collection $students;


    #[ORM\ManyToOne(inversedBy: 'fields')]
    private ?School $school = null;

    /**
     * @var Collection<int, Level>
     */
    #[ORM\OneToMany(targetEntity: Level::class, mappedBy: 'field')]
    private Collection $levels;

    //ues
    #[ORM\ManyToMany(targetEntity: UE::class, inversedBy: 'fields')]
    private Collection $ues;

     /**
     * @return Collection<int, UE>
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): self
    {
        if (!$this->ues->contains($ue)) {
            $this->ues->add($ue);
        }

        return $this;
    }

    public function removeUe(UE $ue): self
    {
        $this->ues->removeElement($ue);

        return $this;
    }


    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->levels = new ArrayCollection();
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

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

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setField($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getField() === $this) {
                $student->setField(null);
            }
        }

        return $this;
    }


    public function __toString():string
    {
        return $this->name;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): static
    {
        $this->school = $school;

        return $this;
    }

    /**
     * @return Collection<int, Level>
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    public function addLevel(Level $level): static
    {
        if (!$this->levels->contains($level)) {
            $this->levels->add($level);
            $level->setField($this);
        }

        return $this;
    }

    public function removeLevel(Level $level): static
    {
        if ($this->levels->removeElement($level)) {
            // set the owning side to null (unless already changed)
            if ($level->getField() === $this) {
                $level->setField(null);
            }
        }

        return $this;
    }

}
