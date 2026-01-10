<?php

namespace App\Mapper;


use App\DTO\VariacaoProdutos\VariacaoProdutosListResponseDTO;
use App\DTO\VariacaoProdutos\VariacaoProdutosResponseDTO;
use App\Entity\VariacaoProdutos;

class VariacaoProdutosMapper
{
    public static function toResponseDto(VariacaoProdutos $variacaoProdutos): VariacaoProdutosResponseDTO
    {
        return new VariacaoProdutosResponseDTO(
            $variacaoProdutos->getId(),
            ProdutosMapper::toResponseDto($variacaoProdutos->getProduto()),
            $variacaoProdutos->getQuantidade(),
            MedidasMapper::toResponseDto($variacaoProdutos->getMedida()),
        );
    }

    public static function toResponseListDto(VariacaoProdutos $variacaoProdutos): VariacaoProdutosListResponseDTO
    {
        return new VariacaoProdutosListResponseDTO(
            $variacaoProdutos->getId(),
            ProdutosMapper::toResumoDto($variacaoProdutos->getProduto()),
            $variacaoProdutos->getQuantidade(),
            MedidasMapper::toResumoDto($variacaoProdutos->getMedida())
        );
    }
}
