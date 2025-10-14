<?php

namespace App\DTO\SubCategorias;

class SubCategoriasListResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $categoria
    ) {}
}
