<?php

namespace App\Mapper;

use App\DTO\PrecoHistoricos\PrecoHistoricosListResponseDTO;
use App\DTO\PrecoHistoricos\PrecoHistoricosResponseDTO;
use App\Entity\PrecoHistoricos;

class PrecoHistoricosMapper
{

    public static function toResponseDto(PrecoHistoricos $precoHistorico): PrecoHistoricosResponseDTO
    {
        return new PrecoHistoricosResponseDTO(
            $precoHistorico->getId(),
            EstabelecimentosMapper::toResponseDto($precoHistorico->getEstabelecimento()),
            VariacaoProdutosMapper::toResponseDto($precoHistorico->getProdutoVariacao()),
            $precoHistorico->getMarca()->getName(),
            $precoHistorico->getValor(),
            $precoHistorico->getDescricao(),
            $precoHistorico->getConsultadoEm()
        );
    }

    public static function toResponseListDto(PrecoHistoricos $precoHistorico): PrecoHistoricosListResponseDTO
    {
        return new PrecoHistoricosListResponseDTO(
            $precoHistorico->getId(),
            $precoHistorico->getEstabelecimento()->getName(),
            $precoHistorico->getProdutoVariacao()->getProduto()->getName(),
            $precoHistorico->getMarca()->getName(),
            $precoHistorico->getValor(),
            $precoHistorico->getDescricao(),
            $precoHistorico->getConsultadoEm()
        );
    }
}
