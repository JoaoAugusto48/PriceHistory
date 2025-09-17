<?php

namespace App\DTO\SubCategorias;

use App\DTO\Categorias\CategoriasResumoDTO;

class SubCategoriasResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly CategoriasResumoDTO $categoria
    ) {}
}
