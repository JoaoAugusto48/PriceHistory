<?php

namespace App\Mapper;

use App\DTO\Produtos\ProdutosResponseDTO;
use App\DTO\SubCategorias\SubCategoriasListResponseDTO;
use App\DTO\SubCategorias\SubCategoriasResponseDTO;
use App\Entity\Produtos;

class ProdutosMapper
{
    public static function toResponseDto(Produtos $produtos): ProdutosResponseDTO
    {
        return new ProdutosResponseDTO(
            $produtos->getId(),
            $produtos->getName(),
            new SubCategoriasListResponseDTO(
                $produtos->getSubCategoria()->getId(),
                $produtos->getSubCategoria()->getName(),
                $produtos->getSubCategoria()->getCategoria()->getId()
            )
        );
    }
}
