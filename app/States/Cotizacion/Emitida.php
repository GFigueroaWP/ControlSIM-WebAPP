<?php

namespace App\States\Cotizacion;

class Emitida extends CotizacionState
{
    protected static $name = 'emitida';

    public function color(): string
    {
        return 'gris';
    }
}
