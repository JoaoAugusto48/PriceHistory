<?php

namespace App\Controller;

use App\Service\PrecoHistoricosService;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/preco/historicos')]
class PrecoHistoricosController
{
    public function __construct(
        private PrecoHistoricosService $precoHistoricoService
    ) {}
}
