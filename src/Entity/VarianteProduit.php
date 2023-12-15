<?php

namespace App\Entity;

use App\Repository\VarianteProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VarianteProduitRepository::class)]
class VarianteProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'idVarianteProduit')]
    private ?FicheProduit $ficheProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFicheProduit(): ?FicheProduit
    {
        return $this->ficheProduit;
    }

    public function setFicheProduit(?FicheProduit $ficheProduit): static
    {
        $this->ficheProduit = $ficheProduit;

        return $this;
    }
}
