<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;

class InscripcionExtraescolar extends Model
{
    protected $table = 'inscripcionextraescolar';
    protected $primaryKey = 'id_inscripcionextra';
    public $timestamps = false;

    protected $fillable = [
        'id_alumno',
        'id_extraescolar',
        'fecha_asignacion',
        'status',
    ];

    public function extraescolar()
    {
        return $this->belongsTo(Extraescolar::class, 'id_extraescolar', 'id_extraescolar');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }
}