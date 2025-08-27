<?php

namespace App\Entity;

use App\Repository\MarcasRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MarcasRepository::class)]
class Marcas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    private string $name;

    #[ORM\Column]
    #[Assert\Blank]
    private ?string $description = null;

    public function __construct(string $name = '', string $description = '') {
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
