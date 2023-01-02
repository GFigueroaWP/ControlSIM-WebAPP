<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateProductos extends Component
{
    use WireToast;

    public $listeners = ['crearProducto'];
    public $prod_nombre, $prod_valor;
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
        $this->reset(['prod_nombre', 'prod_valor']);
    }

    public function submitProducto()
    {

        $this->validate();

        $creado = Producto::create([
            'prod_nombre' => $this->prod_nombre,
            'prod_valor' => $this->prod_valor
        ]);

        $this->modalCreacionProducto = false;

        $this->reset(['prod_nombre', 'prod_valor']);

        activity('Productos')
            ->performedOn($creado)
            ->log('Creado');

        toast()->success('Producto/Servicio añadido con éxito!')->push();

        $this->emit('productoCreado');

        return redirect()->back();
    }

    protected $rules = [
        'prod_nombre' => 'required',
        'prod_valor' => 'required'
    ];

    protected $messages = [];
}
