<?php

namespace App\DTO\PrecoHistoricos;

class SavePrecoHistoricosDTO
{
    public readonly ?int $id;
    public readonly ?int $estabelecimento_id;
    public readonly ?int $variacaoProduto_id;
    public readonly ?int $marca_id;
    public readonly ?float $valor;
    public readonly ?string $descricao;
    public readonly ?string $consultado_em;

    public function __construct(
        ?int $estabelecimento_id,
        ?int $variacaoProduto_id,
        ?int $marca_id,
        ?float $valor,
        ?string $consultado_em = null,
        ?string $descricao = null,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->estabelecimento_id = $estabelecimento_id;
        $this->variacaoProduto_id = $variacaoProduto_id;
        $this->marca_id = $marca_id;
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->consultado_em = $consultado_em;
    }

}
