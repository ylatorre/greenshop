<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'idCommande')]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Liste $idListe = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Avis::class)]
    private Collection $idAvis;

    #[ORM\OneToOne(inversedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Etat $idEtat = null;

    public function __construct()
    {
        $this->idAvis = new ArrayCollection();
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getIdListe(): ?Liste
    {
        return $this->idListe;
    }

    public function setIdListe(?Liste $idListe): static
    {
        $this->idListe = $idListe;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getIdAvis(): Collection
    {
        return $this->idAvis;
    }

    public function addIdAvi(Avis $idAvi): static
    {
        if (!$this->idAvis->contains($idAvi)) {
            $this->idAvis->add($idAvi);
            $idAvi->setCommande($this);
        }

        return $this;
    }

    public function removeIdAvi(Avis $idAvi): static
    {
        if ($this->idAvis->removeElement($idAvi)) {
            // set the owning side to null (unless already changed)
            if ($idAvi->getCommande() === $this) {
                $idAvi->setCommande(null);
            }
        }

        return $this;
    }

    public function getIdEtat(): ?Etat
    {
        return $this->idEtat;
    }

    public function setIdEtat(?Etat $idEtat): static
    {
        $this->idEtat = $idEtat;

        return $this;
    }
}
