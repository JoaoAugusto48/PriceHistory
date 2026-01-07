<?php

namespace App\Entity;

use App\Repository\EstabelecimentosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Enum\TipoEstabelecimentoEnum;

#[ORM\Entity(repositoryClass: EstabelecimentosRepository::class)]
class Estabelecimentos extends BaseEntity
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cidade = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $estado = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $endereco = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $cnpj = null;

    #[ORM\Column(length: 255, type: "string", enumType: TipoEstabelecimentoEnum::class)]
    private TipoEstabelecimentoEnum $tipo;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $telefone = null;

    /**
     * @var Collection<int, PrecoHistorico>
     */
    #[ORM\OneToMany(targetEntity: PrecoHistorico::class, mappedBy: 'estabelecimento')]
    private Collection $produtoVariacao;

    public function __construct()
    {
        $this->produtoVariacao = new ArrayCollection();
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

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): static
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): static
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): static
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getTipo(): ?TipoEstabelecimentoEnum
    {
        return $this->tipo;
    }

    public function setTipo(TipoEstabelecimentoEnum $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): static
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return Collection<int, PrecoHistorico>
     */
    public function getProdutoVariacao(): Collection
    {
        return $this->produtoVariacao;
    }

    public function addProdutoVariacao(PrecoHistorico $produtoVariacao): static
    {
        if (!$this->produtoVariacao->contains($produtoVariacao)) {
            $this->produtoVariacao->add($produtoVariacao);
            $produtoVariacao->setEstabelecimento($this);
        }

        return $this;
    }

    public function removeProdutoVariacao(PrecoHistorico $produtoVariacao): static
    {
        if ($this->produtoVariacao->removeElement($produtoVariacao)) {
            // set the owning side to null (unless already changed)
            if ($produtoVariacao->getEstabelecimento() === $this) {
                $produtoVariacao->setEstabelecimento(null);
            }
        }

        return $this;
    }
}
