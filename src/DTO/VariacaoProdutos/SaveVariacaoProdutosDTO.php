<?php

namespace App\DTO\VariacaoProdutos;

class SaveVariacaoProdutosDTO
{
    public readonly ?int $id;
    public readonly ?int $produto_id;
    public readonly ?float $quantidade;
    public readonly ?int $medida_id;

    public function __construct(
        ?int $produto_id,
        ?float $quantidade,
        ?int $medida_id,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->produto_id = $produto_id;
        $this->quantidade = $quantidade;
        $this->medida_id = $medida_id;
    }
}
