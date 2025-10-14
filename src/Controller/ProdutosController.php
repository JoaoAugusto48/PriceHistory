<?php

namespace App\Controller;

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
    #[Route('', name: 'app_produtos_list')]
    public function produtosList(Request $request): JsonResponse
    {
        $produtos = $this->produtosService->findByFilters();
        $data = [];

        foreach($produtos as $produto) {
            $data[] = ProdutosMapper::toResponseDto($produto);
        }

        return new JsonResponse($data, 200);
    }
}
