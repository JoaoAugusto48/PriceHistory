<?php

namespace App\DTO\Medidas;

class SaveMedidasDTO
{
    public readonly ?int $id;
    public readonly ?string $name;
    public readonly ?string $sigla;
    public readonly ?float $fatorConversao;
    public readonly ?int $medidaBase_id;

    public function __construct(
        ?string $name,
        ?string $sigla,
        ?float $fatorConversao,
        ?int $medidaBase_id = null,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->sigla = $sigla;
        $this->fatorConversao = $fatorConversao;
        $this->medidaBase_id = $medidaBase_id;
    }

}
