<?php

namespace App\Service;

use App\DTO\CategoriasDTO;
use App\DTO\SaveCategoriasDTO;
use App\Entity\Categorias;
use App\Repository\CategoriasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategoriasService
{

    public function __construct(
        private CategoriasRepository $categoriasRepository,
        private ValidatorInterface $validator
    ) {}

    /**
     * Busca pelo Id
     */
    public function findById(int $id): ?Categorias
    {
        return $this->categoriasRepository->find($id);
    }

    /**
     * Busca todos
     * @return Categorias[]
     */
    public function findByFilters(
        ?string $name = null,
        int $limit = 50,
        int $offset = 0,
        string $orderBy = 'id',
        string $direction = 'ASC'
    ): array {
        return $this->categoriasRepository->findBy(
            array_filter(['name' => $name]),
            [$orderBy => $direction],
            $limit,
            $offset
        );
    }

    /**
     * Salva uma Categoria
     */
    public function create(SaveCategoriasDTO $dto, bool $flush = true): Categorias
    {
        $categoria = new Categorias();
        $categoria->setName($dto->name);

        $errors = $this->validator->validate($categoria);
        if(count($errors) > 0){
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->categoriasRepository->save($categoria, $flush);

        return $categoria;
    }

}
