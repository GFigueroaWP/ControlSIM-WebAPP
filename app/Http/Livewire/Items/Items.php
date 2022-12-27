<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    public $listeners = ['itemCreado' => '$refresh'];

    public $filtro_it;

    public function render()
    {
        $filtro_it = '%'.$this->filtro_it .'%';

        return view('livewire.items.items',[
            'items' => Item::latest()
                    ->orWhere('it_nombre','LIKE',$filtro_it)
                    ->paginate(10)
        ]);
    }
}
