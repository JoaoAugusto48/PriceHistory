<?php

namespace App\Mapper;

use App\DTO\Estabelecimentos\EstabelecimentosResponseDTO;
use App\DTO\PrecoHistoricos\PrecoHistoricosResponseDTO;
use App\DTO\PrecoHistoricos\SavePrecoHistoricosDTO;
use App\Entity\PrecoHistoricos;

class PrecoHistoricosMapper
{

    public static function toResponseDto(PrecoHistoricos $precoHistorico): PrecoHistoricosResponseDTO
    {
        return new PrecoHistoricosResponseDTO(
            $precoHistorico->getId(),
            EstabelecimentosMapper::toResponseDto($precoHistorico->getEstabelecimento()),
            VariacaoProdutosMapper::toResponseDto($precoHistorico->getProdutoVariacao()),
            MarcasMapper::toResponseDto($precoHistorico->getMarca()),
            $precoHistorico->getValor(),
            $precoHistorico->getDescricao(),
            $precoHistorico->getConsultadoEm()
        );
    }
}
