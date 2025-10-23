<?php

namespace App\Mapper;

use App\DTO\Categorias\CategoriasResumoDTO;
use App\DTO\Produtos\ProdutosListResponseDTO;
use App\DTO\Produtos\ProdutosResponseDTO;
use App\DTO\SubCategorias\SubCategoriasListResponseDTO;
use App\DTO\SubCategorias\SubCategoriasResponseDTO;
use App\Entity\Produtos;

class ProdutosMapper
{
    public static function toResponseDto(Produtos $produto): ProdutosResponseDTO
    {
        return new ProdutosResponseDTO(
            $produto->getId(),
            $produto->getName(),
            new SubCategoriasResponseDTO(
                $produto->getSubCategoria()->getId(),
                $produto->getSubCategoria()->getName(),
                new CategoriasResumoDTO(
                    $produto->getSubCategoria()->getCategoria()->getId(),
                    $produto->getSubCategoria()->getCategoria()->getName()
                )
            )
        );
    }

    public static function toResponseListDto(Produtos $produto): ProdutosListResponseDTO
    {
        return new ProdutosListResponseDTO(
            $produto->getId(),
            $produto->getName(),
            new SubCategoriasListResponseDTO(
                $produto->getSubCategoria()->getId(),
                $produto->getSubCategoria()->getName(),
                $produto->getSubCategoria()->getCategoria()->getId()
            ),
        );
    }
}
