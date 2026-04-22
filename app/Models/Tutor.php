<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutor';
    protected $primaryKey = 'id_tutor';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'parentesco',
        'telefono',
        'email',
    ];
}
