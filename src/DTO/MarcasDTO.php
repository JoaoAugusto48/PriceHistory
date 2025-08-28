<?php

namespace App\DTO;

class MarcasDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}
