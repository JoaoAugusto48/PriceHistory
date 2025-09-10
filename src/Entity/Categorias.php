<?php

namespace App\Entity;

use App\Repository\CategoriasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriasRepository::class)]
class Categorias extends BaseEntity
{
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    private string $name;

    /**
     * @var Collection<int, SubCategorias>
     */
    #[ORM\OneToMany(targetEntity: SubCategorias::class, mappedBy: 'categoriaId')]
    private Collection $subCategorias;

    public function __construct(string $name = '')
    {
        $this->name = $name;
        $this->subCategorias = new ArrayCollection();
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

    /**
     * @return Collection<int, SubCategorias>
     */
    public function getSubCategorias(): Collection
    {
        return $this->subCategorias;
    }

    public function addSubCategoria(SubCategorias $subCategoria): static
    {
        if (!$this->subCategorias->contains($subCategoria)) {
            $this->subCategorias->add($subCategoria);
            $subCategoria->setCategoriaId($this);
        }

        return $this;
    }

    public function removeSubCategoria(SubCategorias $subCategoria): static
    {
        if ($this->subCategorias->removeElement($subCategoria)) {
            // set the owning side to null (unless already changed)
            if ($subCategoria->getCategoriaId() === $this) {
                $subCategoria->setCategoriaId(null);
            }
        }

        return $this;
    }
}
