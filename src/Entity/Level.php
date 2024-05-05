<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'level')]
    private Collection $students;

    /**
     * @var Collection<int, UE>
     */
    #[ORM\OneToMany(targetEntity: UE::class, mappedBy: 'level')]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

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
            $student->setLevel($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getLevel() === $this) {
                $student->setLevel(null);
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
            $ue->setLevel($this);
        }

        return $this;
    }

    public function removeUe(UE $ue): static
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getLevel() === $this) {
                $ue->setLevel(null);
            }
        }

        return $this;
    }


    public function __toString():string
    {
        return $this->name;
}

}
