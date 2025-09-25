<?php

namespace App\Mapper;

use App\DTO\Estabelecimentos\EstabelecimentosResponseDTO;
use App\Entity\Estabelecimentos;

class EstabelecimentosMapper
{
    public static function toResponseDto(Estabelecimentos $estabelecimentos): EstabelecimentosResponseDTO
    {
        return new EstabelecimentosResponseDTO(
            $estabelecimentos->getId(),
            $estabelecimentos->getName(),
            $estabelecimentos->getCidade(),
            $estabelecimentos->getEstado(),
            $estabelecimentos->getEndereco(),
            $estabelecimentos->getCnpj(),
            $estabelecimentos->getTipo()->name,
            $estabelecimentos->getUrl(),
            $estabelecimentos->getTelefone()
        );
    }
}
