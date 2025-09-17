<?php

namespace App\DTO\Categorias;

class CategoriasResumoDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ) {}
}
