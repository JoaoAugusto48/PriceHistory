<?php

namespace App\DTO\Produtos;

use App\DTO\SubCategorias\SubCategoriasListResponseDTO;

class ProdutosListResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly SubCategoriasListResponseDTO $subCategorias,
    ) {}
}
