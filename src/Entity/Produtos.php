<?php

namespace App\Entity;

use App\Repository\ProdutosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutosRepository::class)]
class Produtos extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'produtos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubCategorias $subCategoria = null;

    /**
     * @var Collection<int, VariacaoProdutos>
     */
    #[ORM\OneToMany(targetEntity: VariacaoProdutos::class, mappedBy: 'produto')]
    private Collection $variacaoProdutos;

    public function __construct()
    {
        $this->variacaoProdutos = new ArrayCollection();
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

    public function getSubCategoria(): ?SubCategorias
    {
        return $this->subCategoria;
    }

    public function setSubCategoria(?SubCategorias $subCategoria): static
    {
        $this->subCategoria = $subCategoria;

        return $this;
    }

    /**
     * @return Collection<int, VariacaoProdutos>
     */
    public function getVariacaoProdutos(): Collection
    {
        return $this->variacaoProdutos;
    }

    public function addVariacaoProdutos(VariacaoProdutos $variacaoProdutos): static
    {
        if (!$this->variacaoProdutos->contains($variacaoProdutos)) {
            $this->variacaoProdutos->add($variacaoProdutos);
            $variacaoProdutos->setProduto($this);
        }

        return $this;
    }

    public function removeVariacaoProdutos(VariacaoProdutos $variacaoProdutos): static
    {
        if ($this->variacaoProdutos->removeElement($variacaoProdutos)) {
            // set the owning side to null (unless already changed)
            if ($variacaoProdutos->getProduto() === $this) {
                $variacaoProdutos->setProduto(null);
            }
        }

        return $this;
    }
}
