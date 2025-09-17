<?php

namespace App\DTO\Categorias;

class CategoriasResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}
}
