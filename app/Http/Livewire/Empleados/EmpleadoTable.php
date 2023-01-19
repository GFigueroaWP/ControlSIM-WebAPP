<?php

namespace App\Http\Livewire\Empleados;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EmpleadoTable extends DataTableComponent
{
    protected $listeners = ['empleadoCreado' => '$refresh', 'empleadoDeshabilitado' => '$refresh'];

    protected $model = User::class;

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
            ButtonGroupColumn::make('Acciones')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Ver')
                        ->title(fn($row) => 'Ver')
                        ->location(fn($row) => route('showEmpleados', $row->id)),
                ]),
            /* Column::make("Us telefono", "us_telefono")
                ->sortable(),
            Column::make("Us email", "us_email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(), */
        ];
    }
}
