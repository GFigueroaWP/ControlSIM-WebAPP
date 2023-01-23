<?php

namespace App\Http\Livewire\Clientes;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Cliente;

class ClienteTable extends DataTableComponent
{
    protected $model = Cliente::class;

    protected $listeners = ['refreshCliente' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Rut", "cli_rut")
                ->sortable()
                ->searchable(),
            Column::make("Razón social", "cli_razonsocial")
                ->sortable()
                ->searchable(),
            Column::make("Giro", "cli_giro")
                ->sortable()
                ->searchable(),
            Column::make("Acciones")
                ->label(
                    fn($row, Column $column) => view('livewire.clientes.acciones')->with(['cliente' => $row])
                ),
            /* Column::make("Cli email", "cli_email")
                ->sortable()
                ->searchable()->isHidden(), */
            /* Column::make("Cli telefono", "cli_telefono")
                ->sortable()
                ->searchable(),
            Column::make("Cli direccion", "cli_direccion")
                ->sortable()
                ->searchable(),
            Column::make("Cli comuna", "cli_comuna")
                ->sortable()
                ->searchable(),
            Column::make("Cli ciudad", "cli_ciudad")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->searchable(), */
        ];
    }
}
