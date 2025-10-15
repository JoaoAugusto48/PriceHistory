<?php

namespace App\DTO\Produtos;

class SaveProdutosDTO
{
    public readonly ?int $id;
    public readonly ?string $name;
    public readonly ?int $subCategoria_id;

    public function __construct(
        ?string $name,
        ?int $subCategoria_id,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->subCategoria_id = $subCategoria_id;
    }
}
