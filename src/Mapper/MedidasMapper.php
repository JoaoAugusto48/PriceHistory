<?php

namespace App\Mapper;

use App\DTO\Medidas\MedidasListResponseDTO;
use App\DTO\Medidas\MedidasResponseDTO;
use App\Entity\Medidas;

class MedidasMapper
{
    public static function toResponseDto(?Medidas $medidas): ?MedidasResponseDTO
    {
        if(!$medidas) {
            return null;
        }

        return new MedidasResponseDTO(
            $medidas->getId(),
            $medidas->getName(),
            $medidas->getSigla(),
            $medidas->getFatorConversao(),
            self::toResponseDto($medidas->getMedidaBase())
        );
    }

    public static function toListResponseDto(Medidas $medidas): MedidasListResponseDTO
    {
        return new MedidasListResponseDTO(
            $medidas->getId(),
            $medidas->getName(),
            $medidas->getSigla(),
            $medidas->getFatorConversao(),
            $medidas->getMedidaBase()?->getId()
        );
    }
}
