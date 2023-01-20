<?php

namespace App\Models;

use App\States\Cotizacion\CotizacionState;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStates\HasStates;

class Cotizacion extends Model
{
    use HasFactory;
    use HasStates;
    use SoftDeletes;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'cliente_id',
        'trabajo_id',
        'cot_directorio'
    ];

    protected $casts = [
        'cot_estado' => CotizacionState::class
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y')
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y')
        );
    }

    public function trabajo()
    {
        return $this->hasOne(OrTrabajo::class, 'cotizacion_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'contiene', 'cotizacion_id', 'producto_id')->withPivot(['cantidad'])->withTimestamps();
    }
}
