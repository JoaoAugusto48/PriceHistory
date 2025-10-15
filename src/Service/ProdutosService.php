<?php

namespace App\Service;

use App\DTO\Produtos\SaveProdutosDTO;
use App\Entity\Produtos;
use App\Repository\ProdutosRepository;
use App\Repository\SubCategoriasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProdutosService
{
    public function __construct(
        private ProdutosRepository $repository,
        private ValidatorInterface $validator,
        private SubCategoriasRepository $subCategoriasRepository,
    ) {}

    /**
     * Summary of findById
     * @param int $id
     * @return Produtos|null
     */
    public function findById(int $id): ?Produtos
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
     * @return Produtos[]
     */
    public function findByFilters(
        ?string $name = null,
        int $limit = 50,
        int $offset = 0,
        string $orderBy = 'id',
        string $direction = 'ASC'
    ): array {
        return $this->repository->findBy(
            array_filter([
                'name' => $name
            ]),
            [$orderBy => $direction],
            $limit,
            $offset
        );
    }

    /**
     * Summary of create
     * @param \App\DTO\Produtos\SaveProdutosDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Produtos
     */
    public function create(SaveProdutosDTO $dto, bool $flush = true): Produtos
    {
        $subCategoria = $this->subCategoriasRepository->findOrFail($dto->subCategoria_id);

        $produto = new Produtos();
        $produto->setName($dto->name);
        $produto->setSubCategoria($subCategoria);

        $errors = $this->validator->validate($produto);
        if(count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($produto, $flush);

        return $produto;
    }
}
