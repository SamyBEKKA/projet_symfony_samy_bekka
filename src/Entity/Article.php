<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameArticle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateArticle = null;

    #[ORM\Column(length: 255)]
    private ?string $shortDescriptionArticle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textArticle = null;

    /**
     * @var Collection<int, CategoriesArticles>
     */
    #[ORM\ManyToMany(targetEntity: CategoriesArticles::class, inversedBy: 'articles')]
    private Collection $categories;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $visibility = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameArticle(): ?string
    {
        return $this->nameArticle;
    }

    public function setNameArticle(string $nameArticle): static
    {
        $this->nameArticle = $nameArticle;

        return $this;
    }

    public function getDateArticle(): ?\DateTimeInterface
    {
        return $this->dateArticle;
    }

    public function setDateArticle(\DateTimeInterface $dateArticle): static
    {
        $this->dateArticle = $dateArticle;

        return $this;
    }

    public function getShortDescriptionArticle(): ?string
    {
        return $this->shortDescriptionArticle;
    }

    public function setShortDescriptionArticle(string $shortDescriptionArticle): static
    {
        $this->shortDescriptionArticle = $shortDescriptionArticle;

        return $this;
    }

    public function getTextArticle(): ?string
    {
        return $this->textArticle;
    }

    public function setTextArticle(string $textArticle): static
    {
        $this->textArticle = $textArticle;

        return $this;
    }

    /**
     * @return Collection<int, categoriesArticles>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(categoriesArticles $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(categoriesArticles $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }
    public function __toString(): string 
    {
        return $this->getNameArticle();
    }
}
