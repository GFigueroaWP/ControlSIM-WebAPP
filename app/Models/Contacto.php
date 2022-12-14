<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'cli_id',
        'con_nombre',
        'con_email',
        'con_telefono',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_id');
    }

}
