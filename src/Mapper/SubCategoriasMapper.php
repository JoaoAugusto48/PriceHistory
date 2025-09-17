<?php

namespace App\Mapper;

use App\DTO\Categorias\CategoriasResumoDTO;
use App\DTO\SubCategorias\SubCategoriasResponseDTO;
use App\Entity\SubCategorias;

class SubCategoriasMapper
{
    public static function toResponseDTO(SubCategorias $subCategorias): SubCategoriasResponseDTO
    {
        return new SubCategoriasResponseDTO(
            $subCategorias->getId(),
            $subCategorias->getName(),
            new CategoriasResumoDTO(
                $subCategorias->getCategoria()->getId(),
                $subCategorias->getCategoria()->getName()
            )
        );
    }
}
