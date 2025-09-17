<?php

namespace App\DTO\Estabelecimentos;
use Symfony\Component\Validator\Constraints as Assert;

class SaveEstabelecimentosDTO
{
    public readonly ?int $id;

    #[Assert\NotBlank(message: 'O nome do estabelecimento não pode estar em branco')]
    public readonly ?string $name;
    public readonly ?string $cidade;
    public readonly ?string $estado;
    public readonly ?string $endereco;
    public readonly ?string $cnpj;
    public readonly ?string $tipo;
    public readonly ?string $url;
    public readonly ?string $telefone;

    public function __construct(
        string $name,
        ?string $cidade = null,
        ?string $estado = null,
        ?string $endereco = null,
        ?string $cnpj = null,
        ?string $tipo = null,
        ?string $url = null,
        ?string $telefone = null,
        ?int $id = null,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->endereco = $endereco;
        $this->cnpj = $cnpj;
        $this->tipo = $tipo;
        $this->url = $url;
        $this->telefone = $telefone;
    }
}
