<?php

namespace App\DTO\PrecoHistoricos;

use App\DTO\Estabelecimentos\EstabelecimentosResponseDTO;
use App\DTO\Marcas\MarcasResponseDTO;
use App\DTO\VariacaoProdutos\VariacaoProdutosResponseDTO;

class PrecoHistoricosResponseDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?EstabelecimentosResponseDTO $estabelecimento,
        public readonly ?VariacaoProdutosResponseDTO $variacaoProduto,
        public readonly ?string $marca,
        public readonly ?float $valor,
        public readonly ?string $descricao,
        public readonly ?\DateTime $consultado_em,
    ) {}
}
