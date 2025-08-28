<?php

namespace App\Service;

use App\DTO\SaveMarcasDTO;
use App\Entity\Marcas;
use App\Repository\MarcasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MarcasService
{
    public function __construct(
        private MarcasRepository $marcasRepository,
        private ValidatorInterface $validator
    ) {}

    /**
     * Busca pelo ID
     */
    public function findById(int $id): ?Marcas
    {
        return $this->marcasRepository->find($id);
    }

    /**
     * Mostra todos
     */
    public function findByFilters(
        ?string $name = null,
        int $limit = 50,
        int $offset = 0,
        string $orderBy = 'id',
        string $direction = 'ASC'
    ): array {
        return $this->marcasRepository->findBy(
            array_filter([
                'name' => $name
            ]),
            [$orderBy => $direction],
            $limit,
            $offset
        );
    }

    /**
     * Salva uma Marca
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

        $this->marcasRepository->save($marca, $flush);

        return $marca;
    }

    /**
     * Atualiza uma Marca
     */
    public function update(SaveMarcasDTO $dto, bool $flush = true): Marcas
    {
        $marca = $this->marcasRepository->find($dto->id);
        $marca->setName($dto->name ?? $marca->getName());
        $marca->setDescription($dto->description ?? $marca->getDescription());

        $errors = $this->validator->validate($marca);
        if (count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->marcasRepository->save($marca, $flush);

        return $marca;
    }

    /**
     * Remove uma marca
     */
    public function remove(int $id, bool $flush = true) {

        $marca = $this->marcasRepository->find($id);

        if(!$marca) {
            throw new \InvalidArgumentException('Marca não encontrada');
        }

        $this->marcasRepository->remove($marca, $flush);
    }
}
