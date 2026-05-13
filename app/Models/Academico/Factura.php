<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;

class Factura extends Model
{
    protected $table      = 'factura';
    protected $primaryKey = 'id_factura';
    public    $timestamps = false;

    protected $fillable = [
        'id_alumno',
        'id_inscripcion',
        'id_inscripcionextra',
        'fecha_emision',
        'fecha_limite',
        'total_pago',
        'vigencia',
        'descripcion',
        'concepto',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion', 'id_inscripcion');
    }

    public function inscripcionExtra()
    {
        return $this->belongsTo(InscripcionExtraescolar::class, 'id_inscripcionextra', 'id_inscripcionextra');
    }
}