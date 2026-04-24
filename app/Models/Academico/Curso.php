<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'id_curso';
    public $timestamps = false;
}