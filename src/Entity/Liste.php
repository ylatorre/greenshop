<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRepository::class)]
class Liste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numeroListe = null;

    #[ORM\Column(length: 255)]
    private ?string $typeListe = null;

    #[ORM\Column(length: 255)]
    private ?string $nomListe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroListe(): ?int
    {
        return $this->numeroListe;
    }

    public function setNumeroListe(int $numeroListe): static
    {
        $this->numeroListe = $numeroListe;

        return $this;
    }

    public function getTypeListe(): ?string
    {
        return $this->typeListe;
    }

    public function setTypeListe(string $typeListe): static
    {
        $this->typeListe = $typeListe;

        return $this;
    }

    public function getNomListe(): ?string
    {
        return $this->nomListe;
    }

    public function setNomListe(string $nomListe): static
    {
        $this->nomListe = $nomListe;

        return $this;
    }
}
