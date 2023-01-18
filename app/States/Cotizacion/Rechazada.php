<?php

namespace App\States\Cotizacion;

class Rechazada extends CotizacionState
{
    protected static $name = 'Rechazada';

    public function color(): string
    {
        return 'rojo';
    }
}
