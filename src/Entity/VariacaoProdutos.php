<?php

namespace App\Entity;

use App\Repository\VariacaoProdutosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariacaoProdutosRepository::class)]
class VariacaoProdutos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $quantidade = null;

    #[ORM\ManyToOne(inversedBy: 'variacaoProdutos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produtos $produto = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medidas $medida = null;

    /**
     * @var Collection<int, PrecoHistoricos>
     */
    #[ORM\OneToMany(targetEntity: PrecoHistoricos::class, mappedBy: 'produtoVariacao')]
    private Collection $PrecoHistoricos;

    public function __construct()
    {
        $this->PrecoHistoricos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantidade(): ?float
    {
        return $this->quantidade;
    }

    public function setQuantidade(float $quantidade): static
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getProduto(): ?Produtos
    {
        return $this->produto;
    }

    public function setProduto(?Produtos $produto): static
    {
        $this->produto = $produto;

        return $this;
    }

    public function getMedida(): ?Medidas
    {
        return $this->medida;
    }

    public function setMedida(?Medidas $medida): static
    {
        $this->medida = $medida;

        return $this;
    }

    /**
     * @return Collection<int, PrecoHistoricos>
     */
    public function getPrecoHistoricos(): Collection
    {
        return $this->PrecoHistoricos;
    }

    public function addPrecoHistoricos(PrecoHistoricos $PrecoHistoricos): static
    {
        if (!$this->PrecoHistoricos->contains($PrecoHistoricos)) {
            $this->PrecoHistoricos->add($PrecoHistoricos);
            $PrecoHistoricos->setProdutoVariacao($this);
        }

        return $this;
    }

    public function removePrecoHistoricos(PrecoHistoricos $PrecoHistoricos): static
    {
        if ($this->PrecoHistoricos->removeElement($PrecoHistoricos)) {
            // set the owning side to null (unless already changed)
            if ($PrecoHistoricos->getProdutoVariacao() === $this) {
                $PrecoHistoricos->setProdutoVariacao(null);
            }
        }

        return $this;
    }
}
