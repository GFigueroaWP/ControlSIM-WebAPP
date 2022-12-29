<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'cli_id',
        'cot_directorio'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_id');
    }

    public function productos(){
        return $this->belongsToMany(Item::class, 'contiene', 'cotizacion_id', 'item_id')->withPivot(['cantidad'])->withTimestamps();
    }
}
