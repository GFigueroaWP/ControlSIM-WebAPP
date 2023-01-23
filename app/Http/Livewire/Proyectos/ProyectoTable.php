<?php

namespace App\Http\Livewire\Proyectos;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Cotizacion;
use Carbon\Carbon;

class ProyectoTable extends DataTableComponent
{
    protected $model = Cotizacion::class;

    protected $listeners = ['refreshProyecto' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Cotización", "id")
                ->sortable()
                ->searchable()->format(
                    fn($value, $row, Column $column) => 'COT-'.str_pad($row->id,5,'0',STR_PAD_LEFT) ?? ''
                ),
            Column::make("Cliente", "cliente.cli_razonsocial")
                ->sortable()
                ->searchable(),
            Column::make("Emitida", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Ultima actualización de cotización", "updated_at")
                ->sortable()
                ->searchable()->deselected(),
            Column::make("Estado de cotización", "cot_estado")
                ->sortable()
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => '<strong class="'.$row->cot_estado.'">'.$row->cot_estado.'</strong>'
                )->html(),
            Column::make("Trabajo", "trabajo.id")
                ->sortable()
                ->searchable()->format(
                    fn($value, $row, Column $column) => 'OT-'.str_pad(optional($row->trabajo)->id,5,'0',STR_PAD_LEFT)
                ),
            Column::make("Estado de trabajo", "trabajo.ot_estado")
                ->sortable()
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => '<h1 hidden></h1><strong class="'.optional($row->trabajo)->ot_estado.'">'.optional($row->trabajo)->ot_estado.'</strong>'
                )
                ->html(),
            Column::make("Fecha de inicio", "trabajo.ot_inicio")
                ->sortable()
                ->searchable()->deselected()->format(
                    fn($value, $row, Column $column) => Carbon::parse(optional($row->trabajo)->ot_inicio)->format('d-m-Y')
                ),
            Column::make("Fecha limite", "trabajo.ot_limite")
                ->sortable()
                ->searchable()->deselected()->format(
                    fn($value, $row, Column $column) => Carbon::parse(optional($row->trabajo)->ot_limite)->format('d-m-Y')
                ),
            Column::make("Ultima actualizacion", "trabajo.ot_completada")
                ->sortable()
                ->searchable()->deselected()->format(
                    fn($value, $row, Column $column) => Carbon::parse(optional($row->trabajo)->ot_completada)->format('d-m-Y')
                ),
            Column::make("Acciones")
                ->label(
                    fn($row, Column $column) => view('livewire.proyectos.acciones')->with(['cotizacion' => $row])
                ),
        ];
    }
}
