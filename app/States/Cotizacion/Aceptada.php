<?php

namespace App\States\Cotizacion;

class Aceptada extends CotizacionState
{
    protected static $name = 'Aceptada';

    public function color(): string
    {
        return 'verde';
    }
}
