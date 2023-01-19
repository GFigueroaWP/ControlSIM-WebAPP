<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class CotizacionDoc extends Controller
{
    public function generateCotizacion(Cotizacion $cotizacion){
        $customer = new Party([
            'name'          => $cotizacion->cliente->cli_razonsocial,
            'custom_fields' => [
                'rut'   => $cotizacion->cliente->cli_rut,
                'giro'   => $cotizacion->cliente->cli_giro,
                'direccion'=> $cotizacion->cliente->cli_direccion,
                'comuna' => $cotizacion->cliente->cli_comuna,
                'ciudad' => $cotizacion->cliente->cli_ciudad,
                'telefono' => $cotizacion->cliente->cli_telefono,
                'email' => $cotizacion->cliente->cli_email,
            ]
        ]);

        foreach($cotizacion->productos as $producto){
            $items[] = (new InvoiceItem())->title($producto->prod_nombre)->description($producto->prod_detalle)->pricePerUnit($producto->prod_valor)->quantity($producto->pivot->cantidad);
        }

            $fecha = Carbon::parse($cotizacion->created_at)->format('d/m/Y');
            $fecha2 = Carbon::createFromFormat( 'd/m/Y' , $fecha);

        $invoice = Invoice::make('cotizacion')
            ->status(($cotizacion->cot_estado))
            ->sequence($cotizacion->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->buyer($customer)
            ->date($fecha2)
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('Pesos')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->addItems($items)
            ->taxRate(19)
            ->logo(public_path('vendor/invoices/cotizacion-logo.png'));

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
