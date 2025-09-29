<?php

namespace App\Controller;

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
}
