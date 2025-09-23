<?php

namespace App\Exception;

class EstabelecimentosNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Estabelecimento não encontrado.");
    }
}
