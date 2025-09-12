<?php

namespace App\Mapper;

use App\DTO\CategoriasResumoDTO;
use App\DTO\SubCategoriasDTO;
use App\Entity\SubCategorias;

class SubCategoriasMapper
{
    public static function toResponseDTO(SubCategorias $subCategorias): SubCategoriasDTO
    {
        return new SubCategoriasDTO(
            $subCategorias->getId(),
            $subCategorias->getName(),
            new CategoriasResumoDTO(
                $subCategorias->getCategoria()->getId(),
                $subCategorias->getCategoria()->getName()
            )
        );
    }
}
