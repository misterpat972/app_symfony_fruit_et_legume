<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\ORM\Mapping as ORM;
// symfony validator permet d'exercer un contrôle sur les données saisies par l'utilisateur //
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: AlimentRepository::class)]
// utilisation du bundle vich
#[Vich\Uploadable]
 
 
class Aliment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    // on ajoute une contrainte de validation pour le nom de l'aliment avec assert\length  //
    #[Assert\Length(min: 3, max: 15, minMessage: "Le nom de l'aliment doit faire au moins 3 caractères", maxMessage: "Le nom de l'aliment doit faire au maximum 15 caractères")]
    private ?string $nom = null;

    #[ORM\Column]
    // on ajoute une contrainte de validation pour le prix de l'aliment avec assert\range //
    #[Assert\Range(min : 3, max : 15, notInRangeMessage : "Le nom de l'aliment doit être compris entre 3 et 15 caractères")]
    private ?float $prix = null;
    
    #[ORM\Column(length: 255)]
    private ?string $image = null;

    // ajout d'une propriété pour stocker le nom du fichier temporairement //
    #[Vich\UploadableField(mapping:"aliment_image", fileNameProperty:"image")]   
    private ?File $imageFile = null;

    #[ORM\Column]
    private ?int $calories = null;

    #[ORM\Column]
    private ?float $proteine = null;

    #[ORM\Column]
    private ?float $glucide = null;

    #[ORM\Column]
    private ?float $lipide = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
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

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        return $this;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        // if ($image) {
        //     // if 'updatedAt' is not defined in your entity, use another property
        //     $this->updatedAt = new \DateTime('now');
        // }
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getProteine(): ?float
    {
        return $this->proteine;
    }

    public function setProteine(float $proteine): self
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getGlucide(): ?float
    {
        return $this->glucide;
    }

    public function setGlucide(float $glucide): self
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getLipide(): ?float
    {
        return $this->lipide;
    }

    public function setLipide(float $lipide): self
    {
        $this->lipide = $lipide;

        return $this;
    }
}
