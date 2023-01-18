<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\OrTrabajo;
use App\Models\Proyecto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Ordenes extends Component
{

    use AuthorizesRequests;

    public function mount(){
        $this->authorize('viewAny', OrTrabajo::class);
    }


    public function render()
    {
        return view('livewire.trabajos.ordenes',[

        ]);
    }
}
