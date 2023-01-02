<?php

namespace App\States\Cotizacion;

class Emitida extends CotizacionState
{
    protected static $name = 'Emitida';

    public function color(): string
    {
        return 'gris';
    }
}
