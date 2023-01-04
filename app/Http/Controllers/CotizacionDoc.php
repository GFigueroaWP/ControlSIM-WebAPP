<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class CotizacionDoc extends Controller
{
    public function generateCotizacion(Cotizacion $cotizacion){
        $customer = new Party([
            'name'          => $cotizacion->cliente->cli_nombre,
            'address'       => $cotizacion->cliente->cli_direccion.', '.$cotizacion->cliente->cli_comuna,
        ]);

        foreach($cotizacion->productos as $producto){
            $items[] = (new InvoiceItem())->title($producto->prod_nombre)->pricePerUnit($producto->prod_valor)->quantity($producto->pivot->cantidad);
        }

        $invoice = Invoice::make('cotizacion')
            ->status(($cotizacion->cot_estado))
            ->sequence($cotizacion->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->buyer($customer)
            ->date(now())
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('CLP')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->addItems($items)
            ->logo(public_path('vendor/invoices/cotizacion-logo.png'));

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
