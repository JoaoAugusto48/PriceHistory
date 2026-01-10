<?php

namespace App\Controller;

use App\DTO\PrecoHistoricos\SavePrecoHistoricosDTO;
use App\Mapper\PrecoHistoricosMapper;
use App\Service\PrecoHistoricosService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/preco/historicos')]
class PrecoHistoricosController
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
            $data['descricao'],
        );

        try {
            $precoHistorico = $this->precoHistoricoService->create($precoHistoricoDTO);

            return new JsonResponse(PrecoHistoricosMapper::toResponseDto($precoHistorico), 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 500);
        }
    }
}
