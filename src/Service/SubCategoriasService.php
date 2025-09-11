<?php

namespace App\Service;

use App\Entity\SubCategorias;
use App\Repository\SubCategoriasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SubCategoriasService
{
    public function __construct(
        private SubCategoriasRepository $repository,
        private ValidatorInterface $validator
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

}
