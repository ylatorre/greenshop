<?php

namespace App\Entity;

use App\Repository\FicheProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheProduitRepository::class)]
class FicheProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $stock = null;

    #[ORM\Column]
    private ?float $noteProduit = null;

    #[ORM\Column]
    private ?int $nombreDeVente = null;

    #[ORM\Column]
    private ?bool $recyclage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getNoteProduit(): ?float
    {
        return $this->noteProduit;
    }

    public function setNoteProduit(float $noteProduit): static
    {
        $this->noteProduit = $noteProduit;

        return $this;
    }

    public function getNombreDeVente(): ?int
    {
        return $this->nombreDeVente;
    }

    public function setNombreDeVente(int $nombreDeVente): static
    {
        $this->nombreDeVente = $nombreDeVente;

        return $this;
    }

    public function isRecyclage(): ?bool
    {
        return $this->recyclage;
    }

    public function setRecyclage(bool $recyclage): static
    {
        $this->recyclage = $recyclage;

        return $this;
    }
}
