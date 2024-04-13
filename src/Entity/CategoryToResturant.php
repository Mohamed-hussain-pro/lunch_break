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

    #[ORM\ManyToOne(inversedBy: 'category_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?resturant $resturant = null;

    #[ORM\ManyToOne(inversedBy: 'CategoryToResturants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResturant(): ?resturant
    {
        return $this->resturant;
    }

    public function setResturant(?resturant $resturant): static
    {
        $this->resturant = $resturant;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
