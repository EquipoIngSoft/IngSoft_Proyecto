<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sede;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'id_curso';
    public $timestamps = false;

    protected $fillable = [
        'id_sede', 'nombre', 'nivel', 'duracion_semanas',
        'horas_totales', 'costo_base', 'estatus', 'descripcion', 'requisitos'
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_curso', 'id_curso');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }
}