<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Liste::class)]
    private Collection $idFavoris;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Adresse::class)]
    private Collection $idAdresse;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: RepAvis::class)]
    private Collection $idRepAvis;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Avis::class)]
    private Collection $idAvis;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commande::class)]
    private Collection $idCommande;

    public function __construct()
    {
        $this->idFavoris = new ArrayCollection();
        $this->idAdresse = new ArrayCollection();
        $this->idRepAvis = new ArrayCollection();
        $this->idAvis = new ArrayCollection();
        $this->idCommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getIdFavoris(): Collection
    {
        return $this->idFavoris;
    }

    public function addIdFavori(Liste $idFavori): self
    {
        if (!$this->idFavoris->contains($idFavori)) {
            $this->idFavoris->add($idFavori);
            $idFavori->setUser($this);
        }

        return $this;
    }

    public function removeIdFavori(Liste $idFavori): self
    {
        if ($this->idFavoris->removeElement($idFavori)) {
            if ($idFavori->getUser() === $this) {
                $idFavori->setUser(null);
            }
        }

        return $this;
    }

    public function getIdAdresse(): Collection
    {
        return $this->idAdresse;
    }

    public function addIdAdresse(Adresse $idAdresse): self
    {
        if (!$this->idAdresse->contains($idAdresse)) {
            $this->idAdresse->add($idAdresse);
            $idAdresse->setUser($this);
        }

        return $this;
    }

    public function removeIdAdresse(Adresse $idAdresse): self
    {
        if ($this->idAdresse->removeElement($idAdresse)) {
            if ($idAdresse->getUser() === $this) {
                $idAdresse->setUser(null);
            }
        }

        return $this;
    }

    public function getIdRepAvis(): Collection
    {
        return $this->idRepAvis;
    }

    public function addIdRepAvi(RepAvis $idRepAvi): self
    {
        if (!$this->idRepAvis->contains($idRepAvi)) {
            $this->idRepAvis->add($idRepAvi);
            $idRepAvi->setUser($this);
        }

        return $this;
    }

    public function removeIdRepAvi(RepAvis $idRepAvi): self
    {
        if ($this->idRepAvis->removeElement($idRepAvi)) {
            if ($idRepAvi->getUser() === $this) {
                $idRepAvi->setUser(null);
            }
        }

        return $this;
    }

    public function getIdAvis(): Collection
    {
        return $this->idAvis;
    }

    public function addIdAvi(Avis $idAvi): self
    {
        if (!$this->idAvis->contains($idAvi)) {
            $this->idAvis->add($idAvi);
            $idAvi->setUser($this);
        }

        return $this;
    }

    public function removeIdAvi(Avis $idAvi): self
    {
        if ($this->idAvis->removeElement($idAvi)) {
            if ($idAvi->getUser() === $this) {
                $idAvi->setUser(null);
            }
        }

        return $this;
    }

    public function getIdCommande(): Collection
    {
        return $this->idCommande;
    }

    public function addIdCommande(Commande $idCommande): self
    {
        if (!$this->idCommande->contains($idCommande)) {
            $this->idCommande->add($idCommande);
            $idCommande->setUser($this);
        }

        return $this;
    }

    public function removeIdCommande(Commande $idCommande): self
    {
        if ($this->idCommande->removeElement($idCommande)) {
            if ($idCommande->getUser() === $this) {
                $idCommande->setUser(null);
            }
        }

        return $this;
    }
}
