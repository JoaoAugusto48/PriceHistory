<?php

namespace App\Controller;

use App\Entity\Marcas;
use App\Mapper\MarcasMapper;
use App\Repository\MarcasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function PHPSTORM_META\map;

#[Route('/api')]
final class MarcasController extends AbstractController
{

    public function __construct(
        private MarcasRepository $marcasRepository,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {
    }

    #[Route('/marcas', name: 'app_marcas', methods: ['GET'])]
    public function marcasList(Request $request): JsonResponse
    {
        $marcasList = $this->marcasRepository->findAll();
        $data = [];

        foreach ($marcasList as $marca ) {
            $data[] = MarcasMapper::toDTO($marca);
        }

        return new JsonResponse($data);
    }

    #[Route('/marcas/{id}', name: 'app_marcas_id', methods: ['GET'])]
    public function marcaById(int $id, Request $request): JsonResponse
    {
        $marca = $this->marcasRepository->find($id);

        if(!$marca) {
            return new JsonResponse(['error' => 'Marca não encontrada'], 404);
        }

        return new JsonResponse(MarcasMapper::toDTO($marca),);
    }

    #[Route('/marcas/create', name: 'app_add_marcas', methods: ['POST'])]
    public function createMarcas(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $marca = new Marcas();
        $marca->setName($data['name'] ?? '');
        $marca->setDescription($data['description'] ?? '');

        // validação
        $errors = $this->validator->validate($marca);
        if(count($errors) > 0) {
            return new JsonResponse($errors, 400);
        }

        try {
            // Persistencia
            $this->marcasRepository->save($marca, true);

            return new JsonResponse(MarcasMapper::toDTO($marca), 201);

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

        $marca = $this->marcasRepository->find($id);
        $marca->setName($data['name'] ?? $marca->getName());
        $marca->setDescription($data['description'] ?? $marca->getDescription());

        $errors = $this->validator->validate($marca);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        try {
            $this->marcasRepository->save($marca, true);

            return new JsonResponse(MarcasMapper::toDTO($marca), 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => 'Não foi possível atualizar o dado.'], 500);
        }
    }

    #[Route('/marcas/{id}/delete', name: 'app_delete_marcas', methods: ['DELETE'])]
    public function deleteMarcas(int $id, Request $request): JsonResponse
    {
        $data = $this->marcasRepository->find($id);

        if (!$data) {
            return new JsonResponse(['error' => 'Marca não encontrada'], 404);
        }

        try {
            $this->marcasRepository->remove($data, true);

            return new JsonResponse(['status' => 'Marca removida com sucesso!'], 200);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => 'Não foi possível remover o dado.'], 500);
        }
    }
}
