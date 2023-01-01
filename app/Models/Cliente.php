<?php

namespace App\Models;

/* use App\States\Cliente\ClienteState; */
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cli_nombre',
        'cli_razonsocial',
        'cli_giro',
        'cli_rut',
        'cli_email',
        'cli_telefono',
        'cli_direccion',
        'cli_comuna',
        'cli_ciudad'
    ];

    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'cli_id');
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'cli_id');
    }

}
