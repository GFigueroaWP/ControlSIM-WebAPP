<?php

namespace App\States\User;

class Activo extends UserState
{
    protected static $name = 'activo';

    public function color(): string
    {
        return 'verde';
    }
}
