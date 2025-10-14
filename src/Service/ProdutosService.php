<?php

namespace App\Service;

use App\Entity\Produtos;
use App\Repository\ProdutosRepository;

class ProdutosService
{
    public function __construct(
        private ProdutosRepository $repository,
    ) {}

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
}
