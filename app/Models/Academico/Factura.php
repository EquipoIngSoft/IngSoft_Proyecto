<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

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
}