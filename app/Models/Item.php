<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $fillable = [
        'it_nombre',
        'it_valor'
    ];

    public function cotizaciones()
    {
        $this->belongsToMany(Cotizacion::class, 'contiene', 'item_id', 'cotizacion_id')->withTimestamps();
    }
}
