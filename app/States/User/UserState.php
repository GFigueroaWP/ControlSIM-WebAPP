<?php

namespace App\States\User;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class UserState extends State
{

    abstract public function color(): string;

    /**
     * @return StateConfig
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Activo::class)
            ->allowTransition(Activo::class, Deshabilitado::class);
    }
}
