<?php

namespace App\Entity;

use App\Repository\SubCategoriasRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SubCategoriasRepository::class)]
class SubCategorias extends BaseEntity
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'subCategorias')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?Categorias $categoria = null;

    public function __construct(string $name = '')
    {
        $this->name = $name;
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

    public function getCategoria(): ?Categorias
    {
        return $this->categoria;
    }

    public function setCategoriaId(?Categorias $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }
}
