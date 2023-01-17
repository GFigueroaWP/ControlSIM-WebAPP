<?php

namespace App\States\Trabajo;

class Iniciada extends TrabajoState
{
    protected static $name = 'Iniciada';

    public function color(): string
    {
        return 'yellow';
    }
}
