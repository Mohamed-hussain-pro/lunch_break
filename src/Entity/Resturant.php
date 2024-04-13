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
     * @var Collection<int, CategoryToResturant>
     */
    #[ORM\OneToMany(targetEntity: CategoryToResturant::class, mappedBy: 'resturant_id')]
    private Collection $CategoryToResturants;

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
     * @return Collection<int, CategoryToResturant>
     */
    public function getCategoryId(): Collection
    {
        return $this->CategoryToResturants;
    }

    public function addCategoryId(CategoryToResturant $categoryId): static
    {
        if (!$this->CategoryToResturants->contains($categoryId)) {
            $this->CategoryToResturants->add($categoryId);
            $categoryId->setResturantId($this);
        }

        return $this;
    }

    public function removeCategoryId(CategoryToResturant $categoryId): static
    {
        if ($this->CategoryToResturants->removeElement($categoryId)) {
            // set the owning side to null (unless already changed)
            if ($categoryId->getResturantId() === $this) {
                $categoryId->setResturantId(null);
            }
        }

        return $this;
    }
}
