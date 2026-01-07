<?php

namespace App\Entity;

use App\Repository\MarcasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MarcasRepository::class)]
class Marcas extends BaseEntity
{

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    private string $name;

    #[ORM\Column]
    #[Assert\Length(max: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, PrecoHistorico>
     */
    #[ORM\OneToMany(targetEntity: PrecoHistorico::class, mappedBy: 'marca')]
    private Collection $precoHistoricos;

    public function __construct(string $name = '', string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
        $this->precoHistoricos = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $precoHistorico->setMarca($this);
        }

        return $this;
    }

    public function removePrecoHistorico(PrecoHistorico $precoHistorico): static
    {
        if ($this->precoHistoricos->removeElement($precoHistorico)) {
            // set the owning side to null (unless already changed)
            if ($precoHistorico->getMarca() === $this) {
                $precoHistorico->setMarca(null);
            }
        }

        return $this;
    }
}
