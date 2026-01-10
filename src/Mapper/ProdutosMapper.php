<?php

namespace App\Mapper;

use App\DTO\Produtos\ProdutosListResponseDTO;
use App\DTO\Produtos\ProdutosResponseDTO;
use App\DTO\Produtos\ProdutosResumoDTO;
use App\Entity\Produtos;

class ProdutosMapper
{
    public static function toResponseDto(Produtos $produto): ProdutosResponseDTO
    {
        return new ProdutosResponseDTO(
            $produto->getId(),
            $produto->getName(),
            SubCategoriasMapper::toResponseDTO($produto->getSubCategoria())
        );
    }

    public static function toResponseListDto(Produtos $produto): ProdutosListResponseDTO
    {
        return new ProdutosListResponseDTO(
            $produto->getId(),
            $produto->getName(),
            SubCategoriasMapper::toListResponseDto($produto->getSubCategoria()),
        );
    }

    public static function toResumoDto(Produtos $produto): ProdutosResumoDTO
    {
        return new ProdutosResumoDTO(
            $produto->getId(),
            $produto->getName()
        );
    }
}
