<?php

namespace App\DTO\PrecoHistoricos;

class PrecoHistoricosListResponseDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $estabelecimento,
        public readonly ?string $produto,
        public readonly ?string $marca,
        public readonly ?float $valor,
        public readonly ?string $descricao,
        public readonly ?\DateTime $consultado_em,
    ) {}
}
