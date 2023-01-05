<?php

namespace App\Models;

use App\States\Trabajo\TrabajoState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStates\HasStates;

class OrTrabajo extends Model
{
    use HasFactory;
    use HasStates;
    use SoftDeletes;

    protected $fillable = [
        'cotizacion_id',
        'ot_inicio',
        'ot_limite',
        'ot_completada'
    ];

    protected $casts = [
        'ot_estado' => TrabajoState::class
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    public function tecnicos(){
        return $this->belongsToMany(User::class, 'asignado', 'trabajo_id', 'tecnico_id')->withTimestamps();
    }

    public function tareas(){
        return $this->hasMany(Tarea::class, 'trabajo_id');
    }
}
