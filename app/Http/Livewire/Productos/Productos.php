<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class Productos extends Component
{
    use WithPagination;

    public $listeners = ['productoCreado' => '$refresh'];

    public $filtro_prod;

    public function render()
    {
        $filtro_prod = '%' . $this->filtro_prod . '%';

        return view('livewire.productos.productos',[
            'productos' => Producto::latest()
            ->orWhere('prod_nombre', 'LIKE', $filtro_prod)
            ->paginate(10)
        ]);
    }
}
