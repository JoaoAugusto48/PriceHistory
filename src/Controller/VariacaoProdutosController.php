<?php

namespace App\Controller;

use App\DTO\VariacaoProdutos\SaveVariacaoProdutosDTO;
use App\Mapper\VariacaoProdutosMapper;
use App\Service\VariacaoProdutosService;
use SebastianBergmann\CodeUnit\Mapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/variacao/produtos')]
final class VariacaoProdutosController extends AbstractController
{
    public function __construct(
        private VariacaoProdutosService $variacaoProdutosService,
    ) {}

    /**
     * Summary of variacaoProdutosList
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('', name: 'app_variacao_produtos', methods: ['GET'])]
    public function variacaoProdutosList(Request $request): JsonResponse
    {
        $variacaoProdutosList = $this->variacaoProdutosService->findByFilters();
        $data = [];

        foreach($variacaoProdutosList as $variacaoProduto) {
            $data[] = VariacaoProdutosMapper::toResponseListDto($variacaoProduto);
        }

        return new JsonResponse($data, 200);
    }

    /**
     * Summary of variacaoProdutosById
     * @param int $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[route('/{id}', name: 'app_variacao_produtos_id', methods: ['GET'])]
    public function variacaoProdutosById(int $id, Request $request): JsonResponse
    {
        $variacaoProduto = $this->variacaoProdutosService->findById($id);

        if(!$variacaoProduto) {
            return new JsonResponse(['error' => 'Variação de produto não encontrada.']);
        }

        return new JsonResponse(VariacaoProdutosMapper::toResponseDto($variacaoProduto), 200);
    }

    /**
     * Summary of variacaoProdutosCreate
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/create', name: 'app_variacao_produtos_create', methods: ['POST'])]
    public function variacaoProdutosCreate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $variacaoProdutosDTO = new SaveVariacaoProdutosDTO(
            $data['produto_id'],
            $data['quantidade'],
            $data['medida_id'],
        );

        try {
            $variacaoProduto = $this->variacaoProdutosService->create($variacaoProdutosDTO);

            return new JsonResponse(VariacaoProdutosMapper::toResponseDto($variacaoProduto), 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 500);
        }

    }
}
