<?php

namespace App\DTO\Produtos;

use App\DTO\SubCategorias\SubCategoriasResponseDTO;

class ProdutosResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly SubCategoriasResponseDTO $subCategorias,
    ) {}
}
