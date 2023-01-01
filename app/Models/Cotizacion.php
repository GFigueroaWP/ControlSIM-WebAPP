<?php

namespace App\Models;

use App\States\Cotizacion\CotizacionState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Cotizacion extends Model
{
    use HasFactory;
    use HasStates;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'cli_id',
        'cot_directorio'
    ];

    protected $casts = [
        'cot_estado' => CotizacionState::class
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_id');
    }

    public function productos(){
        return $this->belongsToMany(Item::class, 'contiene', 'cotizacion_id', 'item_id')->withPivot(['cantidad'])->withTimestamps();
    }
}
