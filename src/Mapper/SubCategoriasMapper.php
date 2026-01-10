<?php

namespace App\Mapper;

use App\DTO\SubCategorias\SubCategoriasListResponseDTO;
use App\DTO\SubCategorias\SubCategoriasResponseDTO;
use App\Entity\SubCategorias;

class SubCategoriasMapper
{
    public static function toResponseDTO(SubCategorias $subCategorias): SubCategoriasResponseDTO
    {
        return new SubCategoriasResponseDTO(
            $subCategorias->getId(),
            $subCategorias->getName(),
            CategoriasMapper::toResumoDto($subCategorias->getCategoria()),
        );
    }

    public static function toListResponseDto(SubCategorias $subCategorias): SubCategoriasListResponseDTO
    {
        return new SubCategoriasListResponseDTO(
            $subCategorias->getId(),
            $subCategorias->getName(),
            $subCategorias->getCategoria()->getId()
        );
    }
}
