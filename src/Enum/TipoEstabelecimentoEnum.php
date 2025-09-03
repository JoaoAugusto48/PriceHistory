<?php

namespace App\Enum;

enum TipoEstabelecimentoEnum: string
{
    case Fisico = 'fisico';
    case Online = 'online';
    case Misto = 'misto';
}
