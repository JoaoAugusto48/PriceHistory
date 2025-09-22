<?php

namespace App\Service;

use App\DTO\SubCategorias\SaveSubCategoriasDTO;
use App\Entity\SubCategorias;
use App\Repository\CategoriasRepository;
use App\Repository\SubCategoriasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SubCategoriasService
{
    public function __construct(
        private SubCategoriasRepository $repository,
        private ValidatorInterface $validator,
        private CategoriasRepository $categoriasRepository,
    ) {}

    /**
     * Summary of findById
     * @param int $id
     * @return object|null
     */
    public function findById(int $id): ?SubCategorias
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
     * @return array
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
     * @param \App\DTO\SubCategorias\SaveSubCategoriasDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return SubCategorias
     */
    public function create(SaveSubCategoriasDTO $dto, bool $flush = true): SubCategorias
    {
        $categoria = $this->categoriasRepository->find($dto->categoria_id);

        if(!$categoria) {
            throw new \InvalidArgumentException("Categoria {$dto->categoria_id} não encontrada");
        }

        $subCategoria = new SubCategorias();
        $subCategoria->setName($dto->name);
        $subCategoria->setCategoriaId($categoria);

        $this->repository->save($subCategoria, $flush);

        return $subCategoria;
    }

}
