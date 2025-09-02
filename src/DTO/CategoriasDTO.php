<?php

namespace App\DTO;

class CategoriasDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}
}
