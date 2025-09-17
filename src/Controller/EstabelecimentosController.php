<?php

namespace App\Controller;

use App\DTO\Estabelecimentos\SaveEstabelecimentosDTO;
use App\Mapper\EstabelecimentosMapper;
use App\Service\EstabelecimentosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/estabelecimentos')]
final class EstabelecimentosController extends AbstractController
{

    public function __construct(
        private EstabelecimentosService $estabelecimentosService
    ) {}

    /**
     * Summary of estabelecimentosList
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('', name: 'app_estabelecimento', methods: ['GET'])]
    public function estabelecimentosList(Request $request): JsonResponse
    {
        $estabelecimentosList = $this->estabelecimentosService->findByFilters();
        $data = [];

        foreach ($estabelecimentosList as $estabelecimento) {
            $data[] = EstabelecimentosMapper::toDto($estabelecimento);
        }

        return new JsonResponse($data, 200);
    }

    /**
     * Summary of estabelecimentoById
     * @param int $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'app_estabelecimento_id', methods: ['GET'])]
    public function estabelecimentoById(int $id, Request $request): JsonResponse
    {
        $estabelecimento = $this->estabelecimentosService->findById($id);

        if(!$estabelecimento) {
            return new JsonResponse(['error' => 'Estabelecimento não encontrado'], 404);
        }

        return new JsonResponse(EstabelecimentosMapper::toDto($estabelecimento), 200);
    }

    /**
     * Summary of createEstabelecimentos
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/create', name: 'app_estabelecimento_create', methods: ['POST'])]
    public function createEstabelecimentos(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $estabelecimentoDto = new SaveEstabelecimentosDTO(
            $data['name'] ?? null,
            $data['cidade'] ?? null,
            $data['estado'] ?? null,
            $data['endereco'] ?? null,
            $data['cnpj'] ?? null,
            $data['tipo'] ?? null,
            $data['url'] ?? null,
            $data['telefone'] ?? null
        );

        try {
            $estabelecimento = $this->estabelecimentosService->create($estabelecimentoDto);

            return new JsonResponse(EstabelecimentosMapper::toDto($estabelecimento), 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Summary of updateEstabelecimentos
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/{id}/update', name: 'app_estabelecimento_update', methods: ['PUT'])]
    public function updateEstabelecimentos(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $estabelecimentoDto = new SaveEstabelecimentosDTO(
            $data['name'] ?? null,
            $data['cidade'] ?? null,
            $data['estado'] ?? null,
            $data['endereco'] ?? null,
            $data['cnpj'] ?? null,
            $data['tipo'] ?? null,
            $data['url'] ?? null,
            $data['telefone'] ?? null,
            $id,
        );

        try {
            $estabelecimento = $this->estabelecimentosService->update($estabelecimentoDto);

            return new JsonResponse(EstabelecimentosMapper::toDto($estabelecimento), 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Summary of deleteEstabelecimentos
     * @param int $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/{id}/remove', name: 'app_estabelecimento_remove', methods: ['DELETE'])]
    public function deleteEstabelecimentos(int $id, Request $request): JsonResponse
    {
        try {
            $this->estabelecimentosService->delete($id);

            return new JsonResponse(null, 204);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => 'Não foi possível remover o dado.'], 500);
        }
    }
}
