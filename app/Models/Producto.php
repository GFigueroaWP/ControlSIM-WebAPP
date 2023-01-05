<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'prod_nombre',
        'prod_valor'
    ];

    public function cotizaciones()
    {
        $this->belongsToMany(Cotizacion::class, 'contiene', 'producto_id', 'cotizacion_id')->withTimestamps();
    }
}
