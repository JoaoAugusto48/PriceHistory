<?php

namespace App\Controller;

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
}
