<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'idPhoto')]
    private ?FicheProduit $ficheProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
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
