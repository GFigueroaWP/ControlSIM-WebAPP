<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cot_id',
        'ot_id'
    ];

    public function cotizacion(){
        return $this->hasOne(Cotizacion::class);
    }

    public function orden(){
        return $this->hasOne(OrTrabajo::class);
    }
}
