<?php

namespace App\Http\Livewire\Empleados;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class DeshabilitadosTable extends DataTableComponent
{
    protected $listeners = ['refreshEmpleado' => '$refresh'];

    /* protected $model = User::class; */

    public function builder(): Builder
    {
        return User::onlyTrashed();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Rut", "us_rut")
                ->sortable()
                ->searchable(),
            Column::make("Nombre de usuario", "us_username")
                ->sortable()
                ->searchable(),
            Column::make("Nombre", "us_nombre")
                ->sortable()
                ->searchable(),
            Column::make("Apellido", "us_apellido")
                ->sortable()
                ->searchable(),
            Column::make("")
            ->label(
                fn($row, Column $column) => view('livewire.empleados.accionesDeshabilitado')->with(['empleado' => $row])
            )
            /* ButtonGroupColumn::make('Accionesss')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Ver')
                        ->title(fn($row) => 'Ver')
                        ->location(fn($row) => route('showEmpleados', $row->id)),
                ]), */
        ];
    }
}
