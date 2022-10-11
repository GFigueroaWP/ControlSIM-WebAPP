<?php

namespace App\Http\Controllers;

use App\Models\User;

class USerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $empleado)
    {
        return view('livewire.empleados.show' , [
            'empleado' => $empleado
        ]);
    }
}
