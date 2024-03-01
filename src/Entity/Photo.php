<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich; 


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
    private ?FicheProduit $ficheProduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
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


    #[Vich\UploadableField(mapping: 'photos', fileNameProperty: 'image')]
    #[Assert\NotNull(message: "Veuillez fournir une image.")]
    #[Assert\File(mimeTypes: ["image/jpeg", "image/png"], mimeTypesMessage: "Veuillez uploader une image valide (jpeg ou png).")]
    private ?File $imageFile = null;

    public function setImageFile(?File $imageFile = null): void
    {
        
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // Il est nécessaire de mettre à jour l'entité pour que la date de mise à jour soit modifiée
            // et Doctrine écoute les changements.
            // $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

}
