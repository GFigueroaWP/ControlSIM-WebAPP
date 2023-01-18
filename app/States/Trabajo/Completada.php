<?php

namespace App\States\Trabajo;

class Completada extends TrabajoState
{
    protected static $name = 'Completada';

    public function color(): string
    {
        return 'green';
    }
}
