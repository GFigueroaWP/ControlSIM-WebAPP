<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Productos extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $listeners = ['productoRefresh' => '$refresh'];

    public $filtro_prod;

    public function mount(){
        $this->authorize('viewAny', Producto::class);
    }

    public function render()
    {
        $filtro_prod = '%' . $this->filtro_prod . '%';

        return view('livewire.productos.productos',[
            'productos' => Producto::latest()
            ->orWhere('prod_nombre', 'LIKE', $filtro_prod)
            ->orWhere('id', 'LIKE', $filtro_prod)
            ->orWhere('prod_valor', 'LIKE', $filtro_prod)
            ->paginate(10)
        ]);
    }
}
