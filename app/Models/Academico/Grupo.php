<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profesor;

class Grupo extends Model
{
    protected $table = 'grupo';
    protected $primaryKey = 'id_grupo';
    public $timestamps = false;

    protected $fillable = [
        'id_curso','id_profesor','codigo_grupo',
        'periodo','fecha_inicio','fecha_fin','cupo_maximo','estatus'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_grupo', 'id_grupo');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_profesor', 'id_profesor');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_grupo', 'id_grupo');
    }
}