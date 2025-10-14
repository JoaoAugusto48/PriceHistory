<?php

namespace App\Entity;

use App\Repository\SubCategoriasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Produtos>
     */
    #[ORM\OneToMany(targetEntity: Produtos::class, mappedBy: 'subCategoria')]
    private Collection $produtos;

    public function __construct(string $name = '')
    {
        $this->name = $name;
        $this->produtos = new ArrayCollection();
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

    /**
     * @return Collection<int, Produtos>
     */
    public function getProdutos(): Collection
    {
        return $this->produtos;
    }

    public function addProduto(Produtos $produto): static
    {
        if (!$this->produtos->contains($produto)) {
            $this->produtos->add($produto);
            $produto->setSubCategoria($this);
        }

        return $this;
    }

    public function removeProduto(Produtos $produto): static
    {
        if ($this->produtos->removeElement($produto)) {
            // set the owning side to null (unless already changed)
            if ($produto->getSubCategoria() === $this) {
                $produto->setSubCategoria(null);
            }
        }

        return $this;
    }
}
