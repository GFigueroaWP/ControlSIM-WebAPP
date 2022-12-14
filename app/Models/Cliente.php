<?php

namespace App\Models;

/* use App\States\Cliente\ClienteState; */
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Cliente extends Model
{
    use HasFactory;
    use HasStates;

    protected $fillable = [
        'cli_nombre',
        'cli_razonsocial',
        'cli_rut',
        'cli_email',
        'cli_telefono',
        'cli_direccion',
        'cli_comuna',
        'cli_region'
    ];

    protected $casts = [
        /* 'cli_estado' => ClienteState::class */
    ];

    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'cli_id');
    }


}
