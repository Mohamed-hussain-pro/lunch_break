<?php

namespace App\Entity;

use App\Repository\ResturantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResturantRepository::class)]
class Resturant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $telefonnummer = null;

    /**
     * @var Collection<int, CategoryToResurant>
     */
    #[ORM\OneToMany(targetEntity: CategoryToResurant::class, mappedBy: 'resturant_id')]
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getTelefonnummer(): ?string
    {
        return $this->telefonnummer;
    }

    public function setTelefonnummer(string $telefonnummer): static
    {
        $this->telefonnummer = $telefonnummer;

        return $this;
    }

    /**
     * @return Collection<int, CategoryToResurant>
     */
    public function getCategoryId(): Collection
    {
        return $this->categoryToResurants;
    }

    public function addCategoryId(CategoryToResurant $categoryId): static
    {
        if (!$this->categoryToResurants->contains($categoryId)) {
            $this->categoryToResurants->add($categoryId);
            $categoryId->setResturantId($this);
        }

        return $this;
    }

    public function removeCategoryId(CategoryToResurant $categoryId): static
    {
        if ($this->categoryToResurants->removeElement($categoryId)) {
            // set the owning side to null (unless already changed)
            if ($categoryId->getResturantId() === $this) {
                $categoryId->setResturantId(null);
            }
        }

        return $this;
    }
}
