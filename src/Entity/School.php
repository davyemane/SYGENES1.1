<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchoolRepository::class)]
class School
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    /**
     * @var Collection<int, Field>
     */
    #[ORM\OneToMany(targetEntity: Field::class, mappedBy: 'school')]
    private Collection $fields;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\OneToMany(targetEntity: Role::class, mappedBy: 'school')]
    private Collection $Roles;

    /**
     * @var Collection<int, ColorScheme>
     */
    #[ORM\OneToMany(targetEntity: ColorScheme::class, mappedBy: 'school', cascade: ['persist', 'remove'])]
    private Collection $colors;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->Roles = new ArrayCollection();
        $this->colors = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

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
     * @return Collection<int, Field>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(Field $field): static
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
            $field->setSchool($this);
        }

        return $this;
    }

    public function removeField(Field $field): static
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getSchool() === $this) {
                $field->setSchool(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->Roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->Roles->contains($role)) {
            $this->Roles->add($role);
            $role->setSchool($this);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        if ($this->Roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getSchool() === $this) {
                $role->setSchool(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ColorScheme>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(ColorScheme $color): static
    {
        if (!$this->colors->contains($color)) {
            $this->colors->add($color);
            $color->setSchool($this);
        }

        return $this;
    }

    public function removeColor(ColorScheme $color): static
    {
        if ($this->colors->removeElement($color)) {
            // set the owning side to null (unless already changed)
            if ($color->getSchool() === $this) {
                $color->setSchool(null);
            }
        }

        return $this;
    }

}
