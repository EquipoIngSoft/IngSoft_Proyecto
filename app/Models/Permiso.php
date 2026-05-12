<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';
    public $timestamps = false;

    protected $fillable = [
        'alumno_ver',
        'alumno_edit',
        'profesor_ver',
        'profesor_edit',
        'personal_ver',
        'personal_edit',
        'roles_ver',
        'roles_edit',
        'sedes_ver',
        'sedes_edit',
        'grupos_ver',
        'grupos_edit',
        'extracurriculares_ver',
        'extracurriculares_edit',
        'estatus_ver',
        'pagos_ver',
        'pagos_edit',
        'niveles_ver',
        'niveles_edit',
    ];
}
