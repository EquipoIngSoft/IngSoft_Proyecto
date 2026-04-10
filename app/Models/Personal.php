<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Personal extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'personal';
    protected $primaryKey = 'id_personal';
    public $timestamps = false;

    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido_p',
        'apellido_m',
        'estado_residencia',
        'ciudad',
        'calle',
        'codigo_postal',
        'genero',
        'fecha_nacimiento',
        'telefono',
        'email',
        'contraseña',
        'estatus',
    ];

    protected $hidden = ['contraseña'];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
