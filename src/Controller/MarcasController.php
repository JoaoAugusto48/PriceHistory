<?php

namespace App\Controller;

use App\DTO\SaveMarcasDTO;
use App\Mapper\MarcasMapper;
use App\Service\MarcasService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class MarcasController extends AbstractController
{

    public function __construct(
        private MarcasService $marcasService,
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/marcas', name: 'app_marcas', methods: ['GET'])]
    public function marcasList(Request $request): JsonResponse
    {
        $marcasList = $this->marcasService->findByFilters();
        $data = [];

        foreach ($marcasList as $marca ) {
            $data[] = MarcasMapper::toDTO($marca);
        }

        return new JsonResponse($data);
    }

    #[Route('/marcas/{id}', name: 'app_marcas_id', methods: ['GET'])]
    public function marcaById(int $id, Request $request): JsonResponse
    {
        $marca = $this->marcasService->findById($id);

        if(!$marca) {
            return new JsonResponse(['error' => 'Marca não encontrada'], 404);
        }

        return new JsonResponse(MarcasMapper::toDTO($marca),);
    }

    #[Route('/marcas/create', name: 'app_add_marcas', methods: ['POST'])]
    public function createMarcas(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $marcaDto = new SaveMarcasDTO(
            $data['name'] ?? null,
            $data['description'] ?? null
        );

        try {
            $marca = $this->marcasService->create($marcaDto, true);

            return new JsonResponse(MarcasMapper::toDTO($marca), 201);
        } catch (\InvalidArgumentException $e) {

            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (\Throwable $th) {

            return new JsonResponse(['error' => 'Não foi possível salvar o dado.'], 500);
        }
    }

    #[Route('/marcas/{id}/update', name: 'app_edit_marcas', methods: ['PUT'])]
    public function editMarcas(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return new JsonResponse(['error' => 'Marca não encontrada'], 404);
        }

        $marcaDto = new SaveMarcasDTO(
            $data['name'] ?? null,
            $data['description'] ?? null,
            $id,
        );

        try {
            $marca = $this->marcasService->update($marcaDto);

            return new JsonResponse(MarcasMapper::toDTO($marca), 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => 'Não foi possível atualizar o dado.'], 500);
        }
    }

    #[Route('/marcas/{id}/delete', name: 'app_delete_marcas', methods: ['DELETE'])]
    public function deleteMarcas(int $id, Request $request): JsonResponse
    {
        try {
            $this->marcasService->remove($id);

            return new JsonResponse(null, 204);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => 'Não foi possível remover o dado.'], 500);
        }
    }
}
