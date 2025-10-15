<?php

namespace App\Exception;

class ProdutosNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Produto não encontrado.");
    }
}
