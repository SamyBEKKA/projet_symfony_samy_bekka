<?php

namespace App\Entity;

use App\Repository\ImgProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgProduitRepository::class)]
class ImgProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageOne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageTwo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageThree = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFour = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFive = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageSix = null;

    #[ORM\ManyToOne(inversedBy: 'imgs')]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageOne(): ?string
    {
        return $this->imageOne;
    }

    public function setImageOne(?string $imageOne): static
    {
        $this->imageOne = $imageOne;

        return $this;
    }

    public function getImageTwo(): ?string
    {
        return $this->imageTwo;
    }

    public function setImageTwo(?string $imageTwo): static
    {
        $this->imageTwo = $imageTwo;

        return $this;
    }

    public function getImageThree(): ?string
    {
        return $this->imageThree;
    }

    public function setImageThree(?string $imageThree): static
    {
        $this->imageThree = $imageThree;

        return $this;
    }

    public function getImageFour(): ?string
    {
        return $this->imageFour;
    }

    public function setImageFour(?string $imageFour): static
    {
        $this->imageFour = $imageFour;

        return $this;
    }

    public function getImageFive(): ?string
    {
        return $this->imageFive;
    }

    public function setImageFive(?string $imageFive): static
    {
        $this->imageFive = $imageFive;

        return $this;
    }

    public function getImageSix(): ?string
    {
        return $this->imageSix;
    }

    public function setImageSix(?string $imageSix): static
    {
        $this->imageSix = $imageSix;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
