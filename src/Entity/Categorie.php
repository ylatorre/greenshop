<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $marque = null;

    #[ORM\ManyToMany(targetEntity: FicheProduit::class, mappedBy: 'idCategorie')]
    private Collection $ficheProduits;

    public function __construct()
    {
        $this->ficheProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function isMarque(): ?bool
    {
        return $this->marque;
    }

    public function setMarque(bool $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, FicheProduit>
     */
    public function getFicheProduits(): Collection
    {
        return $this->ficheProduits;
    }

    public function addFicheProduit(FicheProduit $ficheProduit): static
    {
        if (!$this->ficheProduits->contains($ficheProduit)) {
            $this->ficheProduits->add($ficheProduit);
            $ficheProduit->addIdCategorie($this);
        }

        return $this;
    }

    public function removeFicheProduit(FicheProduit $ficheProduit): static
    {
        if ($this->ficheProduits->removeElement($ficheProduit)) {
            $ficheProduit->removeIdCategorie($this);
        }

        return $this;
    }
}
