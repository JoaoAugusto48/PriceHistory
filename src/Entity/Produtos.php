<?php

namespace App\Entity;

use App\Repository\ProdutosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutosRepository::class)]
class Produtos extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'produtos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubCategorias $subCategoria = null;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSubCategoria(): ?SubCategorias
    {
        return $this->subCategoria;
    }

    public function setSubCategoria(?SubCategorias $subCategoria): static
    {
        $this->subCategoria = $subCategoria;

        return $this;
    }
}
