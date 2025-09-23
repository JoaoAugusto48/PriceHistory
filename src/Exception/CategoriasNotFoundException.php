<?php

namespace App\Exception;

class CategoriasNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Categoria não encontrada.");
    }
}
