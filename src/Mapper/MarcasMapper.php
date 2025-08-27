<?php

namespace App\Mapper;

use App\DTO\MarcasDTO;
use App\Entity\Marcas;

class MarcasMapper
{
    public static function toDTO(Marcas $marcas): MarcasDTO
    {
        return new MarcasDTO(
            $marcas->getId(),
            $marcas->getName(),
            $marcas->getDescription()
        );
    }
}
