<?php

namespace App\DTO\SubCategorias;

class SaveSubCategoriasDTO
{
    public readonly ?int $id;

    public readonly ?string $name;

    public readonly ?int $categoria_id;

    public function __construct(?string $name, ?int $categoria_id, ?int $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->categoria_id = $categoria_id;
    }
}
