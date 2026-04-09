<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Alumno extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'alumno';
    protected $primaryKey = 'id_alumno';
    public $timestamps = false;

    protected $fillable = [
        'id_tutor',
        'id_sede',
        'nombre',
        'apellido_p',
        'apellido_m',
        'email',
        'contraseña',
        'telefono',
        'estatus',
    ];

    protected $hidden = ['contraseña'];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}