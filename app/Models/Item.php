<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'it_nombre',
        'it_valor'
    ];

    public function cotizaciones()
    {
        $this->belongsToMany(Cotizacion::class, 'contiene', 'item_id', 'cotizacion_id')->withTimestamps();
    }
}
