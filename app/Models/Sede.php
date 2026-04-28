<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table      = 'sede';
    protected $primaryKey = 'id_sede';
    public    $timestamps = false;

    protected $fillable = [
        'nombre',
        'estado_residencia',
        'ciudad',
        'codigo_postal',
        'calle',
        'telefono',
        'email',
        'estatus',
    ];
}