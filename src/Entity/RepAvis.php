<?php

namespace App\Entity;

use App\Repository\RepAvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepAvisRepository::class)]
class RepAvis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'idRepAvis')]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'idAvis', cascade: ['persist', 'remove'])]
    private ?Avis $avis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(?Avis $avis): static
    {
        // unset the owning side of the relation if necessary
        if ($avis === null && $this->avis !== null) {
            $this->avis->setIdAvis(null);
        }

        // set the owning side of the relation if necessary
        if ($avis !== null && $avis->getIdAvis() !== $this) {
            $avis->setIdAvis($this);
        }

        $this->avis = $avis;

        return $this;
    }
}
