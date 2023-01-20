<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Spatie\Activitylog\Models\Activity;

class actividadExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Activity::query()->latest();
    }

    public function headings(): array{
        return [
            'ID actividad',
            'Log',
            'Descripción',
            'ID causante',
            'Nombre de usuario del causante',
            'Tipo de objetivo',
            'ID del objetivo',
            'Fecha de registro',
        ];
    }

    public function map($actividad): array{
        return[
            $actividad->id,
            $actividad->log_name,
            $actividad->description,
            optional($actividad->causer)->id,
            optional($actividad->causer)->us_username,
            class_basename($actividad->subject),
            $actividad->subject->id,
            $actividad->created_at
        ];
    }
}
