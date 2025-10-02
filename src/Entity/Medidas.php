<?php

namespace App\Entity;

use App\Repository\MedidasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedidasRepository::class)]
class Medidas extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $sigla = null;

    #[ORM\Column]
    private ?float $fatorConversao = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'medidas')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private ?self $medidaBase = null;

    public function __construct(
        string $name = '',
        string $sigla = '',
        ?float $fatorConversao = null,
        ?self $medidaBase = null
    ) {
        $this->name = $name;
        $this->sigla = $sigla;
        $this->fatorConversao = $fatorConversao;
        $this->medidaBase = $medidaBase;
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

    public function getSigla(): ?string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): static
    {
        $this->sigla = $sigla;

        return $this;
    }

    public function getFatorConversao(): ?float
    {
        return $this->fatorConversao;
    }

    public function setFatorConversao(float $fatorConversao): static
    {
        $this->fatorConversao = $fatorConversao;

        return $this;
    }

    public function getMedidaBase(): ?self
    {
        return $this->medidaBase;
    }

    public function setMedidaBase(?self $medidaBase): static
    {
        $this->medidaBase = $medidaBase;

        return $this;
    }
}
