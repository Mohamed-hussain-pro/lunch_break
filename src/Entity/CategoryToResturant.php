<?php

namespace App\Entity;

use App\Repository\CategoryToResturantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryToResturantRepository::class)]
class CategoryToResturant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'CategoryToResturants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resturant $resturant = null;

    #[ORM\ManyToOne(inversedBy: 'CategoryToResturants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResturant(): ?Resturant
    {
        return $this->resturant;
    }

    public function setResturant(?Resturant $resturant): self
    {
        $this->resturant = $resturant;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
