<?php

namespace App\States\User;

class Deshabilitado extends UserState
{
    protected static $name = 'deshabilitado';

    public function color(): string
    {
        return 'rojo';
    }

}
