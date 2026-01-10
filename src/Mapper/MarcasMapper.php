<?php

namespace App\Mapper;

use App\DTO\Marcas\MarcasResponseDTO;
use App\DTO\Marcas\MarcasResumoDTO;
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

    public static function toResumoDto(Marcas $marcas): MarcasResumoDTO
    {
        return new MarcasResumoDTO(
            $marcas->getId(),
            $marcas->getName(),
            $marcas->getDescription()
        );
    }
}
