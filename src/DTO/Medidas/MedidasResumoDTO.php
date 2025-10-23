<?php

namespace App\DTO\Medidas;

class MedidasResumoDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?string $sigla,
        public readonly ?float $fatorConversao,
    ) {}
}
