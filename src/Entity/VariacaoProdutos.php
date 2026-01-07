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
     * @var Collection<int, PrecoHistorico>
     */
    #[ORM\OneToMany(targetEntity: PrecoHistorico::class, mappedBy: 'produtoVariacao')]
    private Collection $precoHistoricos;

    public function __construct()
    {
        $this->precoHistoricos = new ArrayCollection();
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
     * @return Collection<int, PrecoHistorico>
     */
    public function getPrecoHistoricos(): Collection
    {
        return $this->precoHistoricos;
    }

    public function addPrecoHistorico(PrecoHistorico $precoHistorico): static
    {
        if (!$this->precoHistoricos->contains($precoHistorico)) {
            $this->precoHistoricos->add($precoHistorico);
            $precoHistorico->setProdutoVariacao($this);
        }

        return $this;
    }

    public function removePrecoHistorico(PrecoHistorico $precoHistorico): static
    {
        if ($this->precoHistoricos->removeElement($precoHistorico)) {
            // set the owning side to null (unless already changed)
            if ($precoHistorico->getProdutoVariacao() === $this) {
                $precoHistorico->setProdutoVariacao(null);
            }
        }

        return $this;
    }
}
