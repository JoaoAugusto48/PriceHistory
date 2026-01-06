<?php

namespace App\Exception;

class VariacaoProdutosNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Variação de produto não encontrada.");
    }
}
