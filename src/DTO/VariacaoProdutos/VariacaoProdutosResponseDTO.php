<?php

namespace App\DTO\VariacaoProdutos;

use App\DTO\Medidas\MedidasResponseDTO;
use App\DTO\Produtos\ProdutosResponseDTO;

class VariacaoProdutosResponseDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?ProdutosResponseDTO $produto,
        public readonly ?float $quantidade,
        public readonly ?MedidasResponseDTO $medida,
    ) {}
}
