<?php

namespace App\Mapper;

use App\DTO\Categorias\CategoriasResponseDTO;
use App\DTO\Categorias\CategoriasResumoDTO;
use App\Entity\Categorias;

class CategoriasMapper
{
    public static function toResponseDto(Categorias $categorias): CategoriasResponseDTO
    {
        return new CategoriasResponseDTO(
            $categorias->getId(),
            $categorias->getName()
        );
    }

    public static function toResumoDto(Categorias $categorias): CategoriasResumoDTO
    {
        return new CategoriasResumoDTO(
            $categorias->getId(),
            $categorias->getName(),
        );
    }
}
