<?php

namespace App\Service;

use App\DTO\SaveEstabelecimentosDTO;
use App\Entity\Estabelecimentos;
use App\Enum\TipoEstabelecimentoEnum;
use App\Repository\EstabelecimentosRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EstabelecimentosService
{
    public function __construct(
        private EstabelecimentosRepository $repository,
        private ValidatorInterface $validator
    ) {}

    public function findById(int $id): ?Estabelecimentos
    {
        return $this->repository->find($id);
    }

    /**
     * Summary of findByFilters
     * @param mixed $name
     * @param int $limit
     * @param int $offset
     * @param string $orderBy
     * @param string $direction
     * @return Estabelecimentos[]
     */
    public function findByFilters(
        ?string $name = null,
        int $limit = 50,
        int $offset = 0,
        string $orderBy = 'id',
        string $direction = 'ASC'
    ): array {
        return $this->repository->findBy(
            array_filter(['name' => $name]),
            [$orderBy => $direction],
            $limit,
            $offset
        );
    }

    /**
     * Summary of create
     * @param \App\DTO\SaveEstabelecimentosDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Estabelecimentos
     */
    public function create(SaveEstabelecimentosDTO $dto, bool $flush = true): Estabelecimentos
    {
        try {
            $tipo = TipoEstabelecimentoEnum::from(strtolower($dto->tipo))->value;
        } catch (\ValueError $th) {
            throw new \InvalidArgumentException("Tipo inválido: {$dto->tipo}");
        }

        $estabelecimentos = new Estabelecimentos();
        $estabelecimentos->setName($dto->name);
        $estabelecimentos->setCidade($dto->cidade);
        $estabelecimentos->setCnpj($dto->cnpj);
        $estabelecimentos->setEndereco($dto->endereco);
        $estabelecimentos->setEstado($dto->estado);
        $estabelecimentos->setTelefone($dto->telefone);
        $estabelecimentos->setUrl($dto->url);

        $estabelecimentos->setTipo($tipo);

        $erros = $this->validator->validate($estabelecimentos);
        if (count($erros) > 0) {
            throw new \InvalidArgumentException((string) $erros);
        }

        $this->repository->save($estabelecimentos, $flush);
        return $estabelecimentos;
    }

    /**
     * Summary of update
     * @param \App\DTO\SaveEstabelecimentosDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return object|null
     */
    public function update(SaveEstabelecimentosDTO $dto, bool $flush = false): Estabelecimentos
    {
        try {
            if($dto->tipo) {
                $tipo = TipoEstabelecimentoEnum::from(strtolower($dto->tipo))->value;
            }
        } catch (\ValueError $e) {
            throw new \InvalidArgumentException("Tipo inválido: {$dto->tipo}");
        }

        $estabelecimento = $this->repository->find($dto->id);

        $estabelecimento->setName($dto->name ?? $estabelecimento->getName());
        $estabelecimento->setCidade($dto->cidade ?? $estabelecimento->getCidade());
        $estabelecimento->setCnpj($dto->cnpj ?? $estabelecimento->getCnpj());
        $estabelecimento->setEndereco($dto->endereco ?? $estabelecimento->getEndereco());
        $estabelecimento->setEstado($dto->estado ?? $estabelecimento->getEstado());
        $estabelecimento->setTelefone($dto->telefone ?? $estabelecimento->getTelefone());
        $estabelecimento->setUrl($dto->url ?? $estabelecimento->getUrl());

        $estabelecimento->setTipo($tipo ?? $estabelecimento->getTipo());

        $erros = $this->validator->validate($estabelecimento);
        if(count($erros) > 0) {
            throw new \InvalidArgumentException((string) $erros);
        }

        $this->repository->save($estabelecimento, $flush);
        return $estabelecimento;
    }
}
