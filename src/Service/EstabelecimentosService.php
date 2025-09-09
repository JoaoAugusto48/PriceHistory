<?php

namespace App\Service;

use App\DTO\SaveEstabelecimentosDTO;
use App\Entity\Estabelecimentos;
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

    public function create(SaveEstabelecimentosDTO $dto, bool $flush = true): Estabelecimentos
    {
        $estabelecimentos = new Estabelecimentos();
        $estabelecimentos->setName($dto->name);
        $estabelecimentos->setCidade($dto->cidade);
        $estabelecimentos->setCnpj($dto->cnpj);
        $estabelecimentos->setEndereco($dto->endereco);
        $estabelecimentos->setEstado($dto->estado);
        $estabelecimentos->setTelefone($dto->telefone);
        $estabelecimentos->setTipo($dto->tipo);
        $estabelecimentos->setUrl($dto->url);

        $erros = $this->validator->validate($estabelecimentos);
        if (count($erros) > 0) {
            throw new \InvalidArgumentException((string) $erros);
        }

        $this->repository->save($estabelecimentos, $flush);

        return $estabelecimentos;
    }
}
