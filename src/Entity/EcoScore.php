<?php

namespace App\Entity;

use App\Repository\EcoScoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcoScoreRepository::class)]
class EcoScore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?int $maxScore = null;

    #[ORM\Column(length: 255)]
    private ?string $normes = null;

    #[ORM\ManyToMany(targetEntity: FicheProduit::class, mappedBy: 'idEcoScore')]
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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getMaxScore(): ?int
    {
        return $this->maxScore;
    }

    public function setMaxScore(int $maxScore): static
    {
        $this->maxScore = $maxScore;

        return $this;
    }

    public function getNormes(): ?string
    {
        return $this->normes;
    }

    public function setNormes(string $normes): static
    {
        $this->normes = $normes;

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
            $ficheProduit->addIdEcoScore($this);
        }

        return $this;
    }

    public function removeFicheProduit(FicheProduit $ficheProduit): static
    {
        if ($this->ficheProduits->removeElement($ficheProduit)) {
            $ficheProduit->removeIdEcoScore($this);
        }

        return $this;
    }
}
