<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class Extraescolar extends Model
{
    protected $table = 'extraescolar';
    protected $primaryKey = 'id_extraescolar';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'cupo_maximo',
        'duracion_semanas',
        'costo_base',
        'fecha_inicio',
        'fecha_fin',
        'estatus',
        'ubicacion',
        'descripcion',
        'requisitos',
    ];

    public function inscripciones()
    {
        return $this->hasMany(InscripcionExtraescolar::class, 'id_extraescolar', 'id_extraescolar');
    }

    public function inscripcionesActivas()
    {
        return $this->hasMany(InscripcionExtraescolar::class, 'id_extraescolar', 'id_extraescolar')
                    ->where('status', true);
    }
}