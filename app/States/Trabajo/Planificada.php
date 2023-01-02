<?php

namespace App\States\Trabajo;

class Planificada extends TrabajoState
{
    protected static $name = 'Planificada';

    public function color(): string
    {
        return 'gris';
    }
}
