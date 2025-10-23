<?php

namespace App\Entity;

use App\Repository\VariacaoProdutosRepository;
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
}
