<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToOne(mappedBy: 'idEtat', cascade: ['persist', 'remove'])]
    private ?Commande $commande = null;

    #[ORM\OneToMany(mappedBy: 'idEtat', targetEntity: FicheProduit::class)]
    private Collection $ficheProduits;

    public function __construct()
    {
        $this->ficheProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        // unset the owning side of the relation if necessary
        if ($commande === null && $this->commande !== null) {
            $this->commande->setIdEtat(null);
        }

        // set the owning side of the relation if necessary
        if ($commande !== null && $commande->getIdEtat() !== $this) {
            $commande->setIdEtat($this);
        }

        $this->commande = $commande;

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
            $ficheProduit->setIdEtat($this);
        }

        return $this;
    }

    public function removeFicheProduit(FicheProduit $ficheProduit): static
    {
        if ($this->ficheProduits->removeElement($ficheProduit)) {
            // set the owning side to null (unless already changed)
            if ($ficheProduit->getIdEtat() === $this) {
                $ficheProduit->setIdEtat(null);
            }
        }

        return $this;
    }
}
