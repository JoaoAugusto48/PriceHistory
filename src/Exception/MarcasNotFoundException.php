<?php

namespace App\Exception;

class MarcasNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Marca não encontrada.");
    }
}
