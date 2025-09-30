<?php

namespace App\Controller;

use App\DTO\Medidas\SaveMedidasDTO;
use App\Mapper\MedidasMapper;
use App\Service\MedidasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/medidas')]
class MedidasController extends AbstractController
{
    public function __construct(
        private MedidasService $medidasService,
    ) {}

    /**
     * Summary of medidaList
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('', name: 'app_medidas_list', methods: ['GET'])]
    public function medidaList(Request $request): JsonResponse
    {
        $medidasList = $this->medidasService->findByFilters();
        $data = [];

        foreach($medidasList as $medida) {
            $data[] = MedidasMapper::toResponseDto($medida);
        }

        return new JsonResponse($data, 200);
    }

    /**
     * Summary of medidaById
     * @param int $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'app_medidas_id', methods: ['GET'])]
    public function medidaById(int $id, Request $request): JsonResponse
    {
        try {
            $result = $this->medidasService->findById($id);

            return new JsonResponse($result, 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 404);
        }
    }

    #[Route('/create', name: 'app_medidas_create', methods: ['POST'])]
    public function medidaCreate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $medidasDto = new SaveMedidasDTO(
            $data['name'] ?? null,
            $data['sigla'] ?? null,
            $data['fatorConversao'] ?? null,
            $data['medidaBase_id'] ?? null,
        );

        try {
            $medida = $this->medidasService->create($medidasDto, true);

            return new JsonResponse(MedidasMapper::toResponseDto($medida), 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 404);
        }
    }
}
