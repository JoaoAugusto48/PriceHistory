<?php

namespace App\Controller;

use App\DTO\Produtos\SaveProdutosDTO;
use App\Mapper\ProdutosMapper;
use App\Service\ProdutosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/produtos')]
final class ProdutosController extends AbstractController
{
    public function __construct(
        private ProdutosService $produtosService,
    ) {}

    /**
     * Summary of produtosList
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('', name: 'app_produtos_list', methods: ['GET'])]
    public function produtosList(Request $request): JsonResponse
    {
        $produtos = $this->produtosService->findByFilters();
        $data = [];

        foreach($produtos as $produto) {
            $data[] = ProdutosMapper::toResponseListDto($produto);
        }

        return new JsonResponse($data, 200);
    }

    /**
     * Summary of produtoById
     * @param int $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'app_produtos_id', methods: ['GET'])]
    public function produtoById(int $id, Request $request): JsonResponse
    {
        $produto = $this->produtosService->findById($id);

        if(!$produto) {
            return new JsonResponse(['error' => 'Produto não encontrado'], 500);
        }

        return new JsonResponse(ProdutosMapper::toResponseDto($produto), 200);
    }

    /**
     * Summary of produtoCreate
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/create', name: 'app_produtos_create', methods: ['POST'])]
    public function produtoCreate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $produtoDTO = new SaveProdutosDTO(
            $data['name'],
            $data['subCategoria_id']
        );

        try {
            $produto = $this->produtosService->create($produtoDTO);

            return new JsonResponse(ProdutosMapper::toResponseDto($produto), 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 500);
        }
    }


}
