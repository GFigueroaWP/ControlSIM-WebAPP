<?php

use App\Http\Livewire\Empleados\Empleados;
use App\Http\Livewire\Empleados\ShowEmpleados;
use App\Http\Livewire\Clientes\Clientes;
use App\Http\Livewire\Clientes\ShowClientes;
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
    Route::get('/empleados/{empleado}', ShowEmpleados::class);
    Route::get('/clientes', Clientes::class)->name('clientes');
    Route::get('/clientes/{cliente}', ShowClientes::class);
});
