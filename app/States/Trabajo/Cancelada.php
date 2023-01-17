<?php

namespace App\States\Trabajo;

class Cancelada extends TrabajoState
{
    protected static $name = 'Cancelada';

    public function color(): string
    {
        return 'red';
    }
}
