<?php

namespace App\Exception;

class PrecoHistoricosNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Histórico de preço não encontrado.");
    }
}
