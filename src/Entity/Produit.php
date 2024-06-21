<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_product = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $quantity = null;

    #[ORM\Column]
    private ?bool $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $long_description = null;

    /**
     * @var Collection<int, ImgProduit>
     */
    #[ORM\OneToMany(targetEntity: ImgProduit::class, mappedBy: 'produit')]
    private Collection $imgs;

    public function __construct()
    {
        $this->imgs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->name_product;
    }

    public function setNameProduct(string $name_product): static
    {
        $this->name_product = $name_product;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isStock(): ?bool
    {
        return $this->stock;
    }

    public function setStock(bool $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): static
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(?string $long_description): static
    {
        $this->long_description = $long_description;

        return $this;
    }

    /**
     * @return Collection<int, ImgProduit>
     */
    public function getImgs(): Collection
    {
        return $this->imgs;
    }

    public function addImg(ImgProduit $img): static
    {
        if (!$this->imgs->contains($img)) {
            $this->imgs->add($img);
            $img->setProduit($this);
        }

        return $this;
    }

    public function removeImg(ImgProduit $img): static
    {
        if ($this->imgs->removeElement($img)) {
            // set the owning side to null (unless already changed)
            if ($img->getProduit() === $this) {
                $img->setProduit(null);
            }
        }

        return $this;
    }
}
