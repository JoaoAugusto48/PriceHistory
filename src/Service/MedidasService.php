<?php

namespace App\Service;

use App\DTO\Medidas\SaveMedidasDTO;
use App\Entity\Medidas;
use App\Repository\MedidasRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MedidasService
{
    public function __construct(
        private MedidasRepository $repository,
        private ValidatorInterface $validator
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

    /**
     * Summary of findByFilters
     * @param mixed $name
     * @param int $limit
     * @param int $offset
     * @param string $orderBy
     * @param string $direction
     * @return Medidas[]
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
     * @param \App\DTO\Medidas\SaveMedidasDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return Medidas
     */
    public function create(SaveMedidasDTO $dto, bool $flush = true): Medidas
    {

        $medidas = new Medidas();
        $medidas->setName($dto->name);
        $medidas->setSigla($dto->sigla);
        $medidas->setFatorConversao($dto->fatorConversao);

        if($dto->medidaBase_id) {
            $relatedMedida = $this->repository->findOrFail($dto->medidaBase_id);
            $medidas->setMedidaBase($relatedMedida);
        }

        $errors = $this->validator->validate($medidas);
        if(count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($medidas, $flush);

        return $medidas;
    }

    /**
     * Summary of delete
     * @param int $id
     * @param bool $flush
     * @return void
     */
    public function delete(int $id, bool $flush = true): void
    {
        $medida = $this->repository->findOrFail($id);

        if(!$medida->getMedidaBase()) {
            $medidasRelacionadas = $this->repository->findBy(['medidaBase' => $medida]);

            if(count($medidasRelacionadas) > 0){
                throw new \DomainException("Operação não realizada: Essa medida é usada como base por outras medidas");
            }
        }

        $this->repository->remove($medida, $flush);
    }

}
