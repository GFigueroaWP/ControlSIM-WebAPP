<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'trabajo_id',
        'tar_estado',
        'tar_descripcion',
        'tar_completada'
    ];

    public function trabajo(){
        return $this->belongsTo(OrTrabajo::class, 'trabajo_id');
    }
}
