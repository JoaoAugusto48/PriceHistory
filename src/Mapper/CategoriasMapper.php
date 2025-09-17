<?php

namespace App\Mapper;

use App\DTO\Categorias\CategoriasResponseDTO;
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
}
