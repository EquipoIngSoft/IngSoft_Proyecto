<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;
}