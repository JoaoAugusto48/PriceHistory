<?php

namespace App\Exception;

class SubCategoriasNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("SubCategoria não encontrada.");
    }
}
