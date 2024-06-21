<?php

namespace App\Entity;

use App\Repository\CategorieProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieProduitRepository::class)]
class CategorieProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Name>
     */
    #[ORM\OneToMany(targetEntity: Name::class, mappedBy: 'categorie_produit')]
    private Collection $coffee;

    public function __construct()
    {
        $this->coffee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Name>
     */
    public function getCoffee(): Collection
    {
        return $this->coffee;
    }

    public function addCoffee(Name $coffee): static
    {
        if (!$this->coffee->contains($coffee)) {
            $this->coffee->add($coffee);
            $coffee->setCategorieProduit($this);
        }

        return $this;
    }

    public function removeCoffee(Name $coffee): static
    {
        if ($this->coffee->removeElement($coffee)) {
            // set the owning side to null (unless already changed)
            if ($coffee->getCategorieProduit() === $this) {
                $coffee->setCategorieProduit(null);
            }
        }

        return $this;
    }
}
