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
            'name'          => 'Empresa Ejemplo S.A.',
            'phone'         => '+56912345678',
            'address'       => 'Calle 12 3020 , Concepcion',
            'custom_fields' => [
                'correo'    => 'empresa@email.cl',
                'rut'   => '11.111.111-1'
            ]
        ]);

            $items = [(new InvoiceItem())->title('servicio ejemplo')->pricePerUnit(500000)->quantity(1),
                        (new InvoiceItem())->title('producto ejemplo')->pricePerUnit(90000)->quantity(3)];

        $invoice = Invoice::make('cotizacion')
            ->status(('Emitida'))
            ->sequence('1')
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
            ->taxRate(19)
            ->logo(public_path('vendor/invoices/cotizacion-logo.png'));

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
