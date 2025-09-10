<?php

namespace App\Controller;

use App\DTO\SaveCategoriasDTO;
use App\Mapper\CategoriasMapper;
use App\Service\CategoriasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/categorias')]
final class CategoriasController extends AbstractController
{

    public function __construct(
        private CategoriasService $categoriasService,
    ) {}

    /**
     * Find all categories
     */
    #[Route('', name: 'app_categorias', methods: ['GET'])]
    public function categoriasList(Request $request): JsonResponse
    {
        $categoriasList = $this->categoriasService->findByFilters();
        $data = [];

        foreach ($categoriasList as $categoria) {
            $data[] = CategoriasMapper::toDto($categoria);
        }

        return new JsonResponse($data);
    }

    /**
     * Find caterory by ID
     */
    #[Route('/{id}', name: 'app_categorias_id', methods: ['GET'])]
    public function categoriaById(int $id, Request $request): JsonResponse
    {
        $categoria = $this->categoriasService->findById($id);

        if(!$categoria) {
            return new JsonResponse(['error' => 'Categoria não encontrada'], 404);
        }

        return new JsonResponse(CategoriasMapper::toDto($categoria), 200);
    }

    /**
     * Creating a new Category
     */
    #[Route('/create', name: 'app_categorias_save', methods: ['POST'])]
    public function createCategorias(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(),true);

        $categoriaDto = new SaveCategoriasDTO($data['name']);

        try {
            $categoria = $this->categoriasService->create($categoriaDto, true);

            return new JsonResponse(CategoriasMapper::toDto($categoria), 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Updating a Category
     */
    #[Route('/{id}/update', name: 'app_categorias_update', methods: ['PUT'])]
    public function updateCategorias(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!$data) {
            return new JsonResponse(['error' => 'Categoria não encontrada'], 404);
        }

        $categoriaDto = new SaveCategoriasDTO(
            $data['name'] ?? null,
            $id
        );

        try {
            $categoria = $this->categoriasService->update($categoriaDto);

            return new JsonResponse(CategoriasMapper::toDto($categoria), 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => 'Não foi possível atualizar o dado.'], 500);
        }
    }

    /**
     * Removing a Category
     */
    #[Route('/{id}/delete', name: 'app_categorias_delete', methods: ['DELETE'])]
    public function deleteCategorias(int $id): JsonResponse
    {
        try {
            $this->categoriasService->delete($id);

            return new JsonResponse(null, 204);
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => $th->getMessage()]);
        }
    }
}
