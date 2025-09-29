<?php

namespace App\DTO\Medidas;

class MedidasResponseDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?string $sigla,
        public readonly ?float $fatorConversao,
        public readonly ?MedidasResponseDTO $medidaBase,
    ) {}
}
