<?php

namespace App\Service;

use App\DTO\Marcas\SaveMarcasDTO;
use App\Entity\Marcas;
use App\Repository\MarcasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MarcasService
{
    public function __construct(
        private MarcasRepository $repository,
        private ValidatorInterface $validator
    ) {}

    /**
     * Summary of findById
     * @param int $id
     * @return Marcas|null
     */
    public function findById(int $id): ?Marcas
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
     * @return Marcas[]
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
     * @param \App\DTO\Marcas\SaveMarcasDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Marcas
     */
    public function create(SaveMarcasDTO $dto, bool $flush = true): Marcas
    {
        $marca = new Marcas();
        $marca->setName($dto->name);
        $marca->setDescription($dto->description);

        $errors = $this->validator->validate($marca);
        if (count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($marca, $flush);

        return $marca;
    }

    /**
     * Summary of update
     * @param \App\DTO\Marcas\SaveMarcasDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Marcas|null
     */
    public function update(SaveMarcasDTO $dto, bool $flush = true): Marcas
    {
        $marca = $this->repository->findOrFail($dto->id);
        $marca->setName($dto->name ?? $marca->getName());
        $marca->setDescription($dto->description ?? $marca->getDescription());

        $errors = $this->validator->validate($marca);
        if (count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($marca, $flush);

        return $marca;
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
        $marca = $this->repository->findOrFail($id);

        if(!$marca) {
            throw new \InvalidArgumentException('Marca não encontrada');
        }

        $this->repository->remove($marca, $flush);
    }
}
