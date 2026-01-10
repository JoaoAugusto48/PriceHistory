<?php

namespace App\Entity;

use App\Repository\PrecoHistoricoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrecoHistoricoRepository::class)]
class PrecoHistoricos extends BaseEntity
{

    #[ORM\ManyToOne(inversedBy: 'precoHistoricos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Estabelecimentos $estabelecimento = null;

    #[ORM\ManyToOne(inversedBy: 'precoHistoricos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VariacaoProdutos $produtoVariacao = null;

    #[ORM\ManyToOne(inversedBy: 'precoHistoricos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marcas $marca = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $valor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $consultado_em = null;

    public function __construct() { }

    public function getEstabelecimento(): ?Estabelecimentos
    {
        return $this->estabelecimento;
    }

    public function setEstabelecimento(?Estabelecimentos $estabelecimento): static
    {
        $this->estabelecimento = $estabelecimento;

        return $this;
    }

    public function getProdutoVariacao(): ?VariacaoProdutos
    {
        return $this->produtoVariacao;
    }

    public function setProdutoVariacao(?VariacaoProdutos $produtoVariacao): static
    {
        $this->produtoVariacao = $produtoVariacao;

        return $this;
    }

    public function getMarca(): ?Marcas
    {
        return $this->marca;
    }

    public function setMarca(?Marcas $marca): static
    {
        $this->marca = $marca;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(float $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getConsultadoEm(): ?\DateTime
    {
        return $this->consultado_em;
    }

    public function setConsultadoEm(\DateTime $consultado_em): static
    {
        $this->consultado_em = $consultado_em;

        return $this;
    }
}
