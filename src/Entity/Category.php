<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, CategoryToResturant>
     */
    #[ORM\OneToMany(targetEntity: CategoryToResturant::class, mappedBy: 'category_id')]
    private Collection $categoryToResturants;

    public function __construct()
    {
        $this->CategoryToResturants = new ArrayCollection();
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
     * @return Collection<int, CategoryToResturant>
     */
    public function getCategoryToResturants(): Collection
    {
        return $this->CategoryToResturants;
    }

    public function addCategoryToResturant(CategoryToResturant $CategoryToResturant): static
    {
        if (!$this->CategoryToResturants->contains($CategoryToResturant)) {
            $this->CategoryToResturants->add($CategoryToResturant);
            $CategoryToResturant->setCategoryId($this);
        }

        return $this;
    }

    public function removeCategoryToResturant(CategoryToResturant $CategoryToResturant): static
    {
        if ($this->CategoryToResturants->removeElement($CategoryToResturant)) {
            // set the owning side to null (unless already changed)
            if ($CategoryToResturant->getCategoryId() === $this) {
                $CategoryToResturant->setCategoryId(null);
            }
        }

        return $this;
    }
}
