<?php

namespace App\Service;

use App\DTO\Categorias\SaveCategoriasDTO;
use App\Entity\Categorias;
use App\Repository\CategoriasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategoriasService
{

    public function __construct(
        private CategoriasRepository $repository,
        private ValidatorInterface $validator
    ) {}

    /**
     * Summary of findById
     * @param int $id
     * @return Categorias|null
     */
    public function findById(int $id): ?Categorias
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
     * @return Categorias[]
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
     * @param \App\DTO\Categorias\SaveCategoriasDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Categorias
     */
    public function create(SaveCategoriasDTO $dto, bool $flush = true): Categorias
    {
        $categoria = new Categorias();
        $categoria->setName($dto->name);

        $errors = $this->validator->validate($categoria);
        if(count($errors) > 0){
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($categoria, $flush);

        return $categoria;
    }

    /**
     * Summary of update
     * @param \App\DTO\Categorias\SaveCategoriasDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Categorias|null
     */
    public function update(SaveCategoriasDTO $dto, bool $flush = true): Categorias
    {
        $categoria = $this->repository->findOrFail($dto->id);
        $categoria->setName($dto->name ?? $categoria->getName());

        $errors = $this->validator->validate($categoria);
        if(count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($categoria, $flush);

        return $categoria;
    }

    /**
     * Summary of delete
     * @param int $id
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return void
     */
    public function delete(int $id, bool $flush = true): void
    {
        $categoria = $this->repository->findOrFail($id);

        $this->repository->remove($categoria, $flush);
    }

}
