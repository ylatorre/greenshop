<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'idFavoris')]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'idListe', cascade: ['persist', 'remove'])]
    private ?Commande $commande = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToMany(targetEntity: FicheProduit::class, mappedBy: 'idListe')]
    private Collection $ficheProduits;

    public function __construct()
    {
        $this->ficheProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroListe(): ?int
    {
        return $this->numeroListe;
    }

    public function setNumeroListe(int $numeroListe): self
    {
        $this->numeroListe = $numeroListe;

        return $this;
    }

    public function getTypeListe(): ?string
    {
        return $this->typeListe;
    }

    public function setTypeListe(string $typeListe): self
    {
        $this->typeListe = $typeListe;

        return $this;
    }

    public function getNomListe(): ?string
    {
        return $this->nomListe;
    }

    public function setNomListe(string $nomListe): self
    {
        $this->nomListe = $nomListe;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $this->commande->setIdListe(null);
        }

        // set the owning side of the relation if necessary
        if ($commande !== null && $commande->getIdListe() !== $this) {
            $commande->setIdListe($this);
        }

        $this->commande = $commande;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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
            $ficheProduit->addIdListe($this);
        }

        return $this;
    }

    public function removeFicheProduit(FicheProduit $ficheProduit): static
    {
        if ($this->ficheProduits->removeElement($ficheProduit)) {
            $ficheProduit->removeIdListe($this);
        }

        return $this;
    }
}
