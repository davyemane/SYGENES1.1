<?php

namespace App\Entity;

use App\Repository\ECRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    #[ORM\Column(type: 'boolean')]
    private $hasTp = false;


    public function getHasTp(): bool
    {
        return $this->hasTp;
    }

    public function setHasTp(bool $hasTp): self
    {
        $this->hasTp = $hasTp;

        return $this;
    }
    /**
     * @var Collection<int, NoteCcTp>
     */
    #[ORM\OneToMany(targetEntity: NoteCcTp::class, mappedBy: 'eC')]
    private Collection $noteCcTps;

    /**
     * @var Collection<int, Anonymat>
     */
    #[ORM\OneToMany(targetEntity: Anonymat::class, mappedBy: 'eC')]
    private Collection $anonymats;

    #[ORM\ManyToOne(inversedBy: 'ecs')]
    private ?Teacher $teacher = null;

    public function __construct()
    {
        $this->noteCcTps = new ArrayCollection();
        $this->anonymats = new ArrayCollection();
    }

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
            $noteCcTp->setEC($this);
        }

        return $this;
    }

    public function removeNoteCcTp(NoteCcTp $noteCcTp): static
    {
        if ($this->noteCcTps->removeElement($noteCcTp)) {
            // set the owning side to null (unless already changed)
            if ($noteCcTp->getEC() === $this) {
                $noteCcTp->setEC(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Anonymat>
     */
    public function getAnonymats(): Collection
    {
        return $this->anonymats;
    }

    public function addAnonymat(Anonymat $anonymat): static
    {
        if (!$this->anonymats->contains($anonymat)) {
            $this->anonymats->add($anonymat);
            $anonymat->setEC($this);
        }

        return $this;
    }

    public function removeAnonymat(Anonymat $anonymat): static
    {
        if ($this->anonymats->removeElement($anonymat)) {
            // set the owning side to null (unless already changed)
            if ($anonymat->getEC() === $this) {
                $anonymat->setEC(null);
            }
        }

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

}
