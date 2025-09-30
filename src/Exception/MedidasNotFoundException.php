<?php

namespace App\Exception;

class MedidasNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Medida não encontrada.");
    }
}
