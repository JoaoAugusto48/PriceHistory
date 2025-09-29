<?php

namespace App\Mapper;

use App\DTO\Medidas\MedidasResponseDTO;
use App\Entity\Medidas;

class MedidasMapper
{
    public static function toResponseDto(Medidas $medidas): MedidasResponseDTO
    {
        return new MedidasResponseDTO(
            $medidas->getId(),
            $medidas->getName(),
            $medidas->getSigla(),
            $medidas->getFatorConversao(),
            MedidasMapper::toResponseDto($medidas->getMedidaBase())
        );
    }
}
