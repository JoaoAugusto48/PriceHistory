<?php

namespace App\Service;

use App\DTO\PrecoHistoricos\SavePrecoHistoricosDTO;
use App\Entity\PrecoHistoricos;
use App\Repository\EstabelecimentosRepository;
use App\Repository\MarcasRepository;
use App\Repository\PrecoHistoricosRepository;
use App\Repository\VariacaoProdutosRepository;
use DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PrecoHistoricosService
{
    public function __construct(
        private PrecoHistoricosRepository $repository,
        private EstabelecimentosRepository $estabelecimentosRepository,
        private VariacaoProdutosRepository $variacaoProdutosRepository,
        private MarcasRepository $marcasRepository,
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

    /**
     * Summary of create
     * @param SavePrecoHistoricosDTO $dto
     * @param bool $flush
     * @throws \InvalidArgumentException
     * @return PrecoHistoricos
     */
    public function create(SavePrecoHistoricosDTO $dto, bool $flush = true): PrecoHistoricos
    {
        $estabelecimento = $this->estabelecimentosRepository->findOrFail($dto->estabelecimento_id);
        $produtoVariacao = $this->variacaoProdutosRepository->findOrFail($dto->variacaoProduto_id);
        $marca = $this->marcasRepository->findOrFail($dto->marca_id);

        $precoHistorico = new PrecoHistoricos();
        $precoHistorico->setEstabelecimento($estabelecimento);
        $precoHistorico->setProdutoVariacao($produtoVariacao);
        $precoHistorico->setMarca($marca);
        $precoHistorico->setValor($dto->valor);
        $precoHistorico->setDescricao($dto->descricao);
        $precoHistorico->setConsultadoEm(new DateTime($dto->consultado_em));

        $errors = $this->validator->validate($precoHistorico);
        if(count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }

        $this->repository->create($precoHistorico, $flush);

        return $precoHistorico;
    }

    /**
     * Summary of delete
     * @param int $id
     * @param bool $flush
     * @return void
     */
    public function delete(int $id, bool $flush = true): void
    {
        $precoHistorico = $this->repository->findOrFail($id);
        $precoHistorico->deactivate();

        $this->repository->save($precoHistorico, $flush);
    }

}
