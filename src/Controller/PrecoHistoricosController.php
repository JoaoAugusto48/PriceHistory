<?php

namespace App\Controller;

use App\DTO\PrecoHistoricos\SavePrecoHistoricosDTO;
use App\Mapper\PrecoHistoricosMapper;
use App\Service\PrecoHistoricosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/preco/historicos')]
final class PrecoHistoricosController extends AbstractController
{
     public function __construct(
        private PrecoHistoricosService $precoHistoricoService
    ) {}

    #[Route('/create', name: 'app_preco_historicos_create', methods: ['POST'])]
    public function precoHistoricoCreate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $precoHistoricoDTO = new SavePrecoHistoricosDTO(
            $data['estabelecimento_id'],
            $data['variacaoProduto_id'],
            $data['marca_id'],
            $data['valor'],
            $data['consultado_em'],
        );

        try {
            $precoHistorico = $this->precoHistoricoService->create($precoHistoricoDTO);

            return new JsonResponse(PrecoHistoricosMapper::toResponseDto($precoHistorico), 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Summary of precoHistoricoUpdate
     * @return JsonResponse
     */
    #[Route('/{id}/update', name: 'app_preco_historicos_update', methods: ['GET', 'POST', 'PUT'])]
    public function precoHistoricoUpdate(): JsonResponse
    {
        return new JsonResponse(['error' => 'Esse objeto não permite esse tipo de operação'], 500);
    }

    /**
     * Summary of precoHistoricoDelete
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/{id}/delete', name: 'app_preco_historicos_update', methods: ['DELETE'])]
    public function precoHistoricoDelete(int $id, Request $request) : JsonResponse
    {
        try {
            $this->precoHistoricoService->delete($id);

            return new JsonResponse(null, 204);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 500);
        }
    }
}
