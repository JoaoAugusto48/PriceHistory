<?php

namespace App\Service;

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
}
