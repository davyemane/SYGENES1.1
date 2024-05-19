<?php

namespace App\Entity;

use App\Repository\ResponsableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsableRepository::class)]
class Responsable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'Responsable', cascade: ['persist', 'remove'])]
    private ?User $userAccount = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUserAccount(): ?User
    {
        return $this->userAccount;
    }

    public function setUserAccount(?User $userAccount): static
    {
        // unset the owning side of the relation if necessary
        if ($userAccount === null && $this->userAccount !== null) {
            $this->userAccount->setResponsable(null);
        }

        // set the owning side of the relation if necessary
        if ($userAccount !== null && $userAccount->getResponsable() !== $this) {
            $userAccount->setResponsable($this);
        }

        $this->userAccount = $userAccount;

        return $this;
    }

    public function __toString():string
    {
        return $this->name;
    }

}
