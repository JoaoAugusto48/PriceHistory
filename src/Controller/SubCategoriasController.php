<?php

namespace App\Controller;

use App\DTO\SubCategorias\SaveSubCategoriasDTO;
use App\Mapper\SubCategoriasMapper;
use App\Service\SubCategoriasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/sub/categorias')]
final class SubCategoriasController extends AbstractController
{
    public function __construct(
        private SubCategoriasService $subCategoriasService
    ) {}

    /**
     * Summary of subCategoriaList
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('', name: 'app_subcategorias_list', methods: ['GET'])]
    public function subCategoriaList(Request $request): JsonResponse
    {
        $subCategoriasList = $this->subCategoriasService->findByFilters();
        $data = [];

        foreach($subCategoriasList as $subCategoria) {
            $data[] = SubCategoriasMapper::toResponseDTO($subCategoria);
        }

        return new JsonResponse($data, 200);
    }

    /**
     * Summary of subCategoriaById
     * @param int $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'app_sub_categoria', methods: ['GET'])]
    public function subCategoriaById(int $id, Request $request): JsonResponse
    {
        $subCategoria = $this->subCategoriasService->findById($id);

        if(!$subCategoria) {
            return new JsonResponse(['error' => 'Sub categoria não encontrada'], 404);
        }

        return new JsonResponse(SubCategoriasMapper::toResponseDTO($subCategoria), 200);
    }

    /**
     * Summary of createSubCategoria
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return JsonResponse
     */
    #[Route('/create', name: 'app_sub_categoria_create', methods: ['POST'])]
    public function createSubCategoria(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $subCategoriaDto = new SaveSubCategoriasDTO(
            $data['name'] ?? null,
            $data['categoria_id'] ?? null
        );

        try {
            $subCategoria = $this->subCategoriasService->create($subCategoriaDto);

            return new JsonResponse(SubCategoriasMapper::toResponseDTO($subCategoria), 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 400);
        }
    }
}
