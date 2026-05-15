<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;

    protected $fillable = ['id_grupo', 'dia_semana', 'hora_inicio', 'hora_fin', 'ubicacion'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }
}