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
     * @var Collection<int, PrecoHistoricos>
     */
    #[ORM\OneToMany(targetEntity: PrecoHistoricos::class, mappedBy: 'marca')]
    private Collection $PrecoHistoricos;

    public function __construct(string $name = '', string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
        $this->PrecoHistoricos = new ArrayCollection();
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
            $PrecoHistoricos->setMarca($this);
        }

        return $this;
    }

    public function removePrecoHistoricos(PrecoHistoricos $PrecoHistoricos): static
    {
        if ($this->PrecoHistoricos->removeElement($PrecoHistoricos)) {
            // set the owning side to null (unless already changed)
            if ($PrecoHistoricos->getMarca() === $this) {
                $PrecoHistoricos->setMarca(null);
            }
        }

        return $this;
    }
}
