<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Profesor extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'profesor';
    protected $primaryKey = 'id_profesor';
    public $timestamps = false;

    protected $fillable = [
        'id_sede',
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
        'puntaje',
        'estatus',
    ];

    protected $hidden = ['contraseña'];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}