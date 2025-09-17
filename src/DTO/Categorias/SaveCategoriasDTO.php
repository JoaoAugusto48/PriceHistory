<?php

namespace App\DTO\Categorias;
use Symfony\Component\Validator\Constraints as Assert;

class SaveCategoriasDTO
{

    public readonly ?int $id;

    #[Assert\NotBlank(message: 'O nome da categoria não pode estar em branco')]
    public readonly ?string $name;

    public function __construct(string $name, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
