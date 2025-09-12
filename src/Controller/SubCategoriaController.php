<?php

namespace App\Controller;

use App\Mapper\SubCategoriasMapper;
use App\Service\SubCategoriasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/sub/categoria')]
final class SubCategoriaController extends AbstractController
{
    public function __construct(
        private SubCategoriasService $subCategoriasService
    ) {}

    #[Route('/{id}', name: 'app_sub_categoria', methods: ['GET'])]
    public function subCategoriaList(int $id, Request $request): JsonResponse
    {
        $subCategoria = $this->subCategoriasService->findById($id);

        if(!$subCategoria) {
            return new JsonResponse(['error' => 'Sub categoria não encontrada'], 404);
        }

        return new JsonResponse(SubCategoriasMapper::toResponseDTO($subCategoria), 200);
    }
}
