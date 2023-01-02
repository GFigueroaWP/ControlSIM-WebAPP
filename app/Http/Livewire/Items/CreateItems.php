<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateItems extends Component
{
    use WireToast;

    public $listeners = ['crearItem'];
    public $it_nombre, $it_valor;
    public $modalCreacionItem = false;

    public function render()
    {
        return view('livewire.items.create-items');
    }

    public function crearItem()
    {
        $this->modalCreacionItem = true;
    }

    public function cancelCrearItem()
    {
        $this->modalCreacionItem = false;
        $this->reset(['it_nombre', 'it_valor']);
    }

    public function submitItem()
    {

        $this->validate();

        $creado = Item::create([
            'it_nombre' => $this->it_nombre,
            'it_valor' => $this->it_valor
        ]);

        $this->modalCreacionItem = false;

        $this->reset(['it_nombre', 'it_valor']);

        activity('Productos')
            ->performedOn($creado)
            ->log('Creado');

        toast()->success('Producto/Servicio añadido con éxito!')->push();

        $this->emit('itemCreado');

        return redirect()->back();
    }

    protected $rules = [
        'it_nombre' => 'required',
        'it_valor' => 'required'
    ];

    protected $messages = [];
}
