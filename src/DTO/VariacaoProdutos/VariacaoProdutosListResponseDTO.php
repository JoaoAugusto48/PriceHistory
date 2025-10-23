<?php

namespace App\DTO\VariacaoProdutos;

use App\DTO\Medidas\MedidasResumoDTO;
use App\DTO\Produtos\ProdutosResumoDTO;

class VariacaoProdutosListResponseDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?ProdutosResumoDTO $produto,
        public readonly ?int $quantidade,
        public readonly ?MedidasResumoDTO $medida,
    ) {}
}
