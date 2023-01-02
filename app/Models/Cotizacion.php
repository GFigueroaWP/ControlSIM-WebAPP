<?php

namespace App\Models;

use App\States\Cotizacion\CotizacionState;
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

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'pr_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_id');
    }

    public function productos(){
        return $this->belongsToMany(Item::class, 'contiene', 'cotizacion_id', 'item_id')->withPivot(['cantidad'])->withTimestamps();
    }
}
