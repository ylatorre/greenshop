<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePreparation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateExpedie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateRecu = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroSuivi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDatePreparation(): ?\DateTimeInterface
    {
        return $this->datePreparation;
    }

    public function setDatePreparation(\DateTimeInterface $datePreparation): static
    {
        $this->datePreparation = $datePreparation;

        return $this;
    }

    public function getDateExpedie(): ?\DateTimeInterface
    {
        return $this->dateExpedie;
    }

    public function setDateExpedie(\DateTimeInterface $dateExpedie): static
    {
        $this->dateExpedie = $dateExpedie;

        return $this;
    }

    public function getDateRecu(): ?\DateTimeInterface
    {
        return $this->dateRecu;
    }

    public function setDateRecu(\DateTimeInterface $dateRecu): static
    {
        $this->dateRecu = $dateRecu;

        return $this;
    }

    public function getNumeroSuivi(): ?string
    {
        return $this->numeroSuivi;
    }

    public function setNumeroSuivi(string $numeroSuivi): static
    {
        $this->numeroSuivi = $numeroSuivi;

        return $this;
    }
}
