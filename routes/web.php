<?php

use App\Http\Controllers\CotizacionDoc;
use App\Http\Livewire\Empleados\Empleados;
use App\Http\Livewire\Empleados\ShowEmpleados;
use App\Http\Livewire\Clientes\Clientes;
use App\Http\Livewire\Clientes\ShowClientes;
use App\Http\Livewire\Cotizaciones\Cotizaciones;
use App\Http\Livewire\Cotizaciones\CreateCotizaciones;
use App\Http\Livewire\Productos\Productos;
use App\Http\Livewire\Proyectos\Proyectos;
use App\Http\Livewire\Trabajos\CreateOrden;
use App\Http\Livewire\Trabajos\Ordenes;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/empleados', Empleados::class)->name('empleados');
    Route::get('/empleados/{empleado}', ShowEmpleados::class)->name('showEmpleados');

    Route::get('/clientes', Clientes::class)->name('clientes');
    Route::get('/clientes/{cliente}', ShowClientes::class)->name('showClientes');

    Route::get('/productos', Productos::class)->name('productos');

    Route::get('/proyectos', Proyectos::class)->name('proyectos');

    Route::get('/cotizaciones', Cotizaciones::class)->name('cotizaciones');
    Route::get('/cotizaciones/create', CreateCotizaciones::class)->name('createCotizaciones');
    Route::get('/cotizaciones/{cotizacion}', [CotizacionDoc::class, 'generateCotizacion'])->name('generarCotizacion');

    Route::get('/ordenes', Ordenes::class)->name('ordenes');
    Route::get('/ordenes/create', CreateOrden::class)->name('createOrdenes');

});
