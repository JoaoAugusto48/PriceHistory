<?php

namespace App\DTO\Marcas;
use Symfony\Component\Validator\Constraints as Assert;

class SaveMarcasDTO
{
    public readonly ?int $id;

    #[Assert\NotBlank(message: 'O nome da marca não pode ser vazio.')]
    public readonly ?string $name;

    #[Assert\Length(
        max: 255,
        maxMessage: "A descrição não pode ter mais de {{ limit }} caracteres"
    )]
    public readonly ?string $description;

    public function __construct(?string $name, ?string $description, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

}
