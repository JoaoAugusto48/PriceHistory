<?php

namespace App\DTO;

class SubCategoriasDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly CategoriasResumoDTO $categoria
    ) {}
}
