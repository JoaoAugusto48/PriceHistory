<?php

namespace App\DTO;

class CategoriasResumoDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ) {}
}
