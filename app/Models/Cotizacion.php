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
        'cli_id',
        'pr_id',
        'cot_directorio',
        'cot_subtotal',
        'cot_total'
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

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'pr_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_id');
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'contiene', 'cotizacion_id', 'producto_id')->withPivot(['cantidad'])->withTimestamps();
    }
}
