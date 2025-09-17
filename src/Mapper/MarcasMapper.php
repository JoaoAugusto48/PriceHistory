<?php

namespace App\Mapper;

use App\DTO\Marcas\MarcasResponseDTO;
use App\Entity\Marcas;

class MarcasMapper
{
    public static function toResponseDto(Marcas $marcas): MarcasResponseDTO
    {
        return new MarcasResponseDTO(
            $marcas->getId(),
            $marcas->getName(),
            $marcas->getDescription()
        );
    }
}
