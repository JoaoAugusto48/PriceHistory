<?php

namespace App\Mapper;

use App\DTO\Categorias\CategoriasResumoDTO;
use App\DTO\Medidas\MedidasResponseDTO;
use App\DTO\Medidas\MedidasResumoDTO;
use App\DTO\Produtos\ProdutosResponseDTO;
use App\DTO\Produtos\ProdutosResumoDTO;
use App\DTO\SubCategorias\SubCategoriasResponseDTO;
use App\DTO\VariacaoProdutos\VariacaoProdutosListResponseDTO;
use App\DTO\VariacaoProdutos\VariacaoProdutosResponseDTO;
use App\Entity\VariacaoProdutos;

class VariacaoProdutosMapper
{
    public static function toResponseDto(VariacaoProdutos $variacaoProdutos): VariacaoProdutosResponseDTO
    {
        return new VariacaoProdutosResponseDTO(
            $variacaoProdutos->getId(),
            new ProdutosResponseDTO(
                $variacaoProdutos->getProduto()->getId(),
                $variacaoProdutos->getProduto()->getName(),
                new SubCategoriasResponseDTO(
                    $variacaoProdutos->getProduto()->getSubCategoria()->getId(),
                    $variacaoProdutos->getProduto()->getSubCategoria()->getName(),
                    new CategoriasResumoDTO(
                        $variacaoProdutos->getProduto()->getSubCategoria()->getCategoria()->getId(),
                        $variacaoProdutos->getProduto()->getSubCategoria()->getCategoria()->getName()
                    )
                )
            ),
            $variacaoProdutos->getQuantidade(),
            new MedidasResponseDTO(
                $variacaoProdutos->getMedida()->getId(),
                $variacaoProdutos->getMedida()->getName(),
                $variacaoProdutos->getMedida()->getSigla(),
                $variacaoProdutos->getMedida()->getFatorConversao(),
                $variacaoProdutos->getMedida()->getMedidaBase()
            )
        );
    }

    public static function toResponseListDto(VariacaoProdutos $variacaoProdutos): VariacaoProdutosListResponseDTO
    {
        return new VariacaoProdutosListResponseDTO(
            $variacaoProdutos->getId(),
            new ProdutosResumoDTO(
                $variacaoProdutos->getProduto()->getId(),
                $variacaoProdutos->getProduto()->getName()
            ),
            $variacaoProdutos->getQuantidade(),
            new MedidasResumoDTO(
                $variacaoProdutos->getMedida()->getId(),
                $variacaoProdutos->getMedida()->getName(),
                $variacaoProdutos->getMedida()->getSigla(),
                $variacaoProdutos->getMedida()->getFatorConversao()
            )
            );
    }
}
