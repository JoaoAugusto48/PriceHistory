<?php

namespace App\Service;

use App\DTO\VariacaoProdutos\SaveVariacaoProdutosDTO;
use App\Entity\VariacaoProdutos;
use App\Repository\MedidasRepository;
use App\Repository\ProdutosRepository;
use App\Repository\VariacaoProdutosRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VariacaoProdutosService
{
    public function __construct(
        private VariacaoProdutosRepository $repository,
        private ValidatorInterface $validator,
        private ProdutosRepository $produtosRepository,
        private MedidasRepository $medidasRepository,
    ) {}

    public function findById(int $id): VariacaoProdutos
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
     * @return VariacaoProdutos[]
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
     * @param \App\DTO\VariacaoProdutos\SaveVariacaoProdutosDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return VariacaoProdutos
     */
    public function create(SaveVariacaoProdutosDTO $dto, bool $flush = true): VariacaoProdutos
    {
        $produto = $this->produtosRepository->findOrFail($dto->produto_id);
        $medida = $this->medidasRepository->findOrFail($dto->medida_id);

        $variacaoProduto = new VariacaoProdutos();
        $variacaoProduto->setQuantidade($dto->quantidade);
        $variacaoProduto->setProduto($produto);
        $variacaoProduto->setMedida($medida);

        $errors = $this->validator->validate($variacaoProduto);
        if(count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->save($variacaoProduto, $flush);

        return $variacaoProduto;
    }

}
