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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'field')]
    private Collection $students;

    /**
     * @var Collection<int, UE>
     */
    #[ORM\ManyToMany(targetEntity: UE::class, inversedBy: 'fields')]
    private Collection $ues;

    public function __construct()
    {
        $this->students = new ArrayCollection();
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

    /**
     * @return Collection<int, UE>
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): static
    {
        if (!$this->ues->contains($ue)) {
            $this->ues->add($ue);
        }

        return $this;
    }

    public function removeUe(UE $ue): static
    {
        $this->ues->removeElement($ue);

        return $this;
    }

    public function __toString():string
    {
        return $this->name;
    }
}
