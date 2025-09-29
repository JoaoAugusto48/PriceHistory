<?php

namespace App\Service;

use App\Entity\Medidas;
use App\Repository\MedidasRepository;

class MedidasService
{
    public function __construct(
        private MedidasRepository $repository,
    ) {}

    /**
     * Summary of findById
     * @param int $id
     * @return Medidas|null
     */
    public function findById(int $id): ?Medidas
    {
        return $this->repository->find($id);
    }

}
