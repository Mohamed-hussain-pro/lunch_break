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
     * @var Collection<int, CategoryToResurant>
     */
    #[ORM\OneToMany(targetEntity: CategoryToResurant::class, mappedBy: 'category_id')]
    private Collection $categoryToResurants;

    public function __construct()
    {
        $this->categoryToResurants = new ArrayCollection();
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
     * @return Collection<int, CategoryToResurant>
     */
    public function getCategoryToResurants(): Collection
    {
        return $this->categoryToResurants;
    }

    public function addCategoryToResurant(CategoryToResurant $categoryToResurant): static
    {
        if (!$this->categoryToResurants->contains($categoryToResurant)) {
            $this->categoryToResurants->add($categoryToResurant);
            $categoryToResurant->setCategoryId($this);
        }

        return $this;
    }

    public function removeCategoryToResurant(CategoryToResurant $categoryToResurant): static
    {
        if ($this->categoryToResurants->removeElement($categoryToResurant)) {
            // set the owning side to null (unless already changed)
            if ($categoryToResurant->getCategoryId() === $this) {
                $categoryToResurant->setCategoryId(null);
            }
        }

        return $this;
    }
}
