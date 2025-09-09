<?php

namespace App\DTO;

class EstabelecimentosDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $cidade,
        public readonly ?string $estado,
        public readonly ?string $endereco,
        public readonly ?string $cnpj,
        public readonly ?string $tipo,
        public readonly ?string $url,
        public readonly ?string $telefone,
    ) {}
}
