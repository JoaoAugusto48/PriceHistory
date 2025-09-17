<?php

namespace App\DTO\Marcas;

class MarcasResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}
