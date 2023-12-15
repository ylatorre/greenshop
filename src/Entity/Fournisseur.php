<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idFournisseur', targetEntity: FicheProduit::class)]
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
            $ficheProduit->setIdFournisseur($this);
        }

        return $this;
    }

    public function removeFicheProduit(FicheProduit $ficheProduit): static
    {
        if ($this->ficheProduits->removeElement($ficheProduit)) {
            // set the owning side to null (unless already changed)
            if ($ficheProduit->getIdFournisseur() === $this) {
                $ficheProduit->setIdFournisseur(null);
            }
        }

        return $this;
    }
}
