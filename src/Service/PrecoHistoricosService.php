<?php

namespace App\Service;

use App\Entity\PrecoHistoricos;
use App\Repository\PrecoHistoricosRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PrecoHistoricosService
{
    public function __construct(
        private PrecoHistoricosRepository $repository,
        private ValidatorInterface $validator
    ) {}

    /**
     * Summary of findById
     * @param int $id
     * @return PrecoHistoricos|null
     */
    public function findById(int $id): ?PrecoHistoricos
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
     * @return PrecoHistoricos[]
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
