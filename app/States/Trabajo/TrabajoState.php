<?php

namespace App\States\Trabajo;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TrabajoState extends State
{

    abstract public function color(): string;

    /**
     * @return StateConfig
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Planificada::class)
            ->allowTransition(Planificada::class, Iniciada::class)
            ->allowTransition(Planificada::class, Cancelada::class)
            ->allowTransition(Planificada::class, Completada::class)
            ->allowTransition(Iniciada::class, Completada::class)
            ->allowTransition(Iniciada::class, Cancelada::class);
    }
}
