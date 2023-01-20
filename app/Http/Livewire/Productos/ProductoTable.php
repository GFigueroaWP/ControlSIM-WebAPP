<?php

namespace App\Http\Livewire\Productos;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Producto;

class ProductoTable extends DataTableComponent
{
    protected $model = Producto::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->format(
                    fn($value, $row, Column $column) => 'PS-'.str_pad($row->id,5,'0',STR_PAD_LEFT)
                )->searchable(),
            Column::make("Prod nombre", "prod_nombre")
                ->sortable()
                ->searchable(),
            Column::make("Prod valor", "prod_valor")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => '$'.number_format($row->prod_valor,0,",",".")
                )->searchable(),
            Column::make("Acciones")
                ->label(
                    fn($row, Column $column) => view('livewire.productos.acciones')->with(['producto' => $row])
                )
            /* Column::make("Prod detalle", "prod_detalle")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(), */
        ];
    }
}
