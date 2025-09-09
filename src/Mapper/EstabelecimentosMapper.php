<?php

namespace App\Mapper;

use App\DTO\EstabelecimentosDTO;
use App\Entity\Estabelecimentos;

class EstabelecimentosMapper
{
    public static function toDto(Estabelecimentos $estabelecimentos): EstabelecimentosDTO
    {
        return new EstabelecimentosDTO(
            $estabelecimentos->getId(),
            $estabelecimentos->getName(),
            $estabelecimentos->getCidade(),
            $estabelecimentos->getEstado(),
            $estabelecimentos->getEndereco(),
            $estabelecimentos->getCnpj(),
            $estabelecimentos->getTipo(),
            $estabelecimentos->getUrl(),
            $estabelecimentos->getTelefone()
        );
    }
}
