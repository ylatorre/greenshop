<?php

namespace App\Entity;

use App\Repository\FicheProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Liste::class, inversedBy: 'ficheProduits')]
    private Collection $idListe;

    #[ORM\ManyToOne(inversedBy: 'ficheProduits')]
    private ?Etat $idEtat = null;

    #[ORM\OneToMany(mappedBy: 'ficheProduit', targetEntity: VarianteProduit::class)]
    private Collection $idVarianteProduit;

    #[ORM\ManyToOne(inversedBy: 'ficheProduits')]
    private ?Fournisseur $idFournisseur = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'ficheProduits')]
    private Collection $idCategorie;

    #[ORM\ManyToMany(targetEntity: EcoScore::class, inversedBy: 'ficheProduits')]
    private Collection $idEcoScore;

    #[ORM\OneToMany(mappedBy: 'ficheProduit', targetEntity: Photo::class, cascade: ['persist'])]
    private Collection $idPhoto;


    // #[ORM\OneToMany(mappedBy: 'ficheProduit', targetEntity: Photo::class, cascade: ['persist'])]
    // private Collection $photos;

    




    

    public function __construct()
    {
        $this->idListe = new ArrayCollection();
        $this->idVarianteProduit = new ArrayCollection();
        $this->idCategorie = new ArrayCollection();
        $this->idEcoScore = new ArrayCollection();
        $this->idPhoto = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Liste>
     */
    public function getIdListe(): Collection
    {
        return $this->idListe;
    }

    public function addIdListe(Liste $idListe): static
    {
        if (!$this->idListe->contains($idListe)) {
            $this->idListe->add($idListe);
        }

        return $this;
    }

    public function removeIdListe(Liste $idListe): static
    {
        $this->idListe->removeElement($idListe);

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

    /**
     * @return Collection<int, VarianteProduit>
     */
    public function getIdVarianteProduit(): Collection
    {
        return $this->idVarianteProduit;
    }

    public function addIdVarianteProduit(VarianteProduit $idVarianteProduit): static
    {
        if (!$this->idVarianteProduit->contains($idVarianteProduit)) {
            $this->idVarianteProduit->add($idVarianteProduit);
            $idVarianteProduit->setFicheProduit($this);
        }

        return $this;
    }

    public function removeIdVarianteProduit(VarianteProduit $idVarianteProduit): static
    {
        if ($this->idVarianteProduit->removeElement($idVarianteProduit)) {
            // set the owning side to null (unless already changed)
            if ($idVarianteProduit->getFicheProduit() === $this) {
                $idVarianteProduit->setFicheProduit(null);
            }
        }

        return $this;
    }

    public function getIdFournisseur(): ?Fournisseur
    {
        return $this->idFournisseur;
    }

    public function setIdFournisseur(?Fournisseur $idFournisseur): static
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getIdCategorie(): Collection
    {
        return $this->idCategorie;
    }

    public function addIdCategorie(Categorie $idCategorie): static
    {
        if (!$this->idCategorie->contains($idCategorie)) {
            $this->idCategorie->add($idCategorie);
        }

        return $this;
    }

    public function removeIdCategorie(Categorie $idCategorie): static
    {
        $this->idCategorie->removeElement($idCategorie);

        return $this;
    }

    /**
     * @return Collection<int, EcoScore>
     */
    public function getIdEcoScore(): Collection
    {
        return $this->idEcoScore;
    }

    public function addIdEcoScore(EcoScore $idEcoScore): static
    {
        if (!$this->idEcoScore->contains($idEcoScore)) {
            $this->idEcoScore->add($idEcoScore);
        }

        return $this;
    }

    public function removeIdEcoScore(EcoScore $idEcoScore): static
    {
        $this->idEcoScore->removeElement($idEcoScore);

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getIdPhoto(): Collection
    {
        return $this->idPhoto;
    }

    public function addIdPhoto(Photo $idPhoto): static
    {
        if (!$this->idPhoto->contains($idPhoto)) {
            $this->idPhoto->add($idPhoto);
            $idPhoto->setFicheProduit($this);
        }

        return $this;
    }

    public function removeIdPhoto(Photo $idPhoto): static
    {
        if ($this->idPhoto->removeElement($idPhoto)) {
            // set the owning side to null (unless already changed)
            if ($idPhoto->getFicheProduit() === $this) {
                $idPhoto->setFicheProduit(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    private ?string $imageProduit = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;  // Ajoutez cette propriété

    public function setImageProduit(?string $imageProduit): static
    {
        $this->imageProduit = $imageProduit;
    
        return $this;
    }
    
    public function getImageProduit(): ?string
    {
        return $this->imageProduit;
    }
    public function getImagesProduit(): array
    {
        $images = [];

        foreach ($this->idPhoto as $photo) {
            // Assurez-vous que la méthode getImage() dans votre entité Photo retourne le chemin ou l'URL de l'image
            $images[] = $photo->getImage();
        }

        return $images;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }


}
