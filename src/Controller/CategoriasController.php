<?php

namespace App\Controller;

use App\DTO\SaveCategoriasDTO;
use App\Mapper\CategoriasMapper;
use App\Service\CategoriasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class CategoriasController extends AbstractController
{

    public function __construct(
        private CategoriasService $categoriasService,
    ) {}

    /**
     * Find all categories
     */
    #[Route('/categorias', name: 'app_categorias')]
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
    #[Route('/categorias/{id}', name: 'app_categorias_id')]
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
    #[Route('/categorias/create', name: 'app_categorias_save')]
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
}
