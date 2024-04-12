<?php

namespace App\Entity;

use App\Repository\CategoryToResurantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryToResurantRepository::class)]
class CategoryToResurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'category_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?resturant $resturant_id = null;

    #[ORM\ManyToOne(inversedBy: 'categoryToResurants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?category $category_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResturantId(): ?resturant
    {
        return $this->resturant_id;
    }

    public function setResturantId(?resturant $resturant_id): static
    {
        $this->resturant_id = $resturant_id;

        return $this;
    }

    public function getCategoryId(): ?category
    {
        return $this->category_id;
    }

    public function setCategoryId(?category $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }
}
