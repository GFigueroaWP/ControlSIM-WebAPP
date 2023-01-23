<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class UpdateProductos extends Component
{
    use WireToast;

    protected $listeners = ['modificarProducto'];
    public $modalEdicionProducto = false;
    public $prod_nombre, $prod_valor, $prod_detalle, $seleccionado;

    public function render()
    {
        return view('livewire.productos.update-productos');
    }

    public function modificarProducto(Producto $producto){
        $this->modalEdicionProducto = true;
        $this->seleccionado = $producto;
        $this->fill([
            'prod_nombre' => $producto->prod_nombre,
            'prod_valor' => $producto->prod_valor,
            'prod_detalle' => $producto->prod_detalle
        ]);
    }

    public function cancelEditarProducto()
    {
        $this->modalEdicionProducto = false;
        $this->reset(['prod_nombre', 'prod_valor', 'prod_detalle']);
    }

    public function editProducto()
    {

        $this->validate();

        $this->seleccionado->prod_nombre = $this->prod_nombre;
        $this->seleccionado->prod_valor = $this->prod_valor;
        $this->seleccionado->prod_detalle = $this->prod_detalle;

        $this->seleccionado->save();

        $this->modalEdicionProducto = false;

        $this->reset(['prod_nombre', 'prod_valor', 'prod_detalle']);

        activity('Producto')
            ->performedOn($this->seleccionado)
            ->log('Editado');

        toast()->info('Producto/Servicio editado')->push();

        $this->emit('productoRefresh');

        return redirect()->back();
    }

    protected $rules = [
        'prod_nombre' => 'required|string',
        'prod_valor' => 'required|numeric'
    ];

    protected $messages = [
        'prod_nombre.required' => 'El Campo de Nombre es Obligatorio',
        'prod_nombre.string' => 'El Campo de Nombre debe ser alfanumérico',
        'prod_valor.required' => 'El Campo de Precio es Obligatorio',
        'prod_valor.numeric' => 'El Campo de Precio debe ser numérico'
    ];
}
