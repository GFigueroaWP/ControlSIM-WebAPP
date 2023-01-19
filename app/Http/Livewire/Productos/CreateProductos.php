<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateProductos extends Component
{
    use WireToast;

    public $listeners = ['crearProducto'];
    public $prod_nombre, $prod_valor, $prod_detalle;
    public $modalCreacionProducto = false;

    public function render()
    {
        return view('livewire.productos.create-productos');
    }

    public function crearProducto()
    {
        $this->modalCreacionProducto = true;
    }

    public function cancelCrearProducto()
    {
        $this->modalCreacionProducto = false;
        $this->reset(['prod_nombre', 'prod_valor', 'prod_detalle']);
    }

    public function submitProducto()
    {

        $this->validate();

        $creado = Producto::create([
            'prod_nombre' => $this->prod_nombre,
            'prod_valor' => $this->prod_valor,
            'prod_detalle' => $this->prod_detalle
        ]);

        $this->modalCreacionProducto = false;

        $this->reset(['prod_nombre', 'prod_valor', 'prod_detalle']);

        activity('Producto')
            ->performedOn($creado)
            ->log('Creado');

        toast()->success('Producto/Servicio añadido con éxito!')->push();

        $this->emit('productoCreado');

        return redirect()->back();
    }

    protected $rules = [
        'prod_nombre' => 'required|string',
        'prod_valor' => 'required|numeric',
        'prod_detalle' => 'string'
    ];

    protected $messages = [
        'prod_nombre.required' => 'El Campo de Nombre es Obligatorio',
        'prod_nombre.string' => 'El Campo de Nombre debe ser alfanumérico',
        'prod_valor.required' => 'El Campo de Precio es Obligatorio',
        'prod_valor.numeric' => 'El Campo de Precio debe ser numérico',
        'prod_detalle.string' => 'El Campo de Descripción debe ser alfanumérico'
    ];
}
