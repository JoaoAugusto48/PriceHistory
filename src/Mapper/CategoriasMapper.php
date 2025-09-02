<?php

namespace App\Mapper;

use App\DTO\CategoriasDTO;
use App\Entity\Categorias;

class CategoriasMapper
{
    public static function toDto(Categorias $categorias): CategoriasDTO
    {
        return new CategoriasDTO(
            $categorias->getId(),
            $categorias->getName()
        );
    }
}
