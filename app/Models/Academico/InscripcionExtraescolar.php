<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class InscripcionExtraescolar extends Model
{
    protected $table = 'inscripcionextraescolar';
    protected $primaryKey = 'id_inscripcionextra';
    public $timestamps = false;

    public function extraescolar()
    {
        return $this->belongsTo(Extraescolar::class, 'id_extraescolar', 'id_extraescolar');
    }
}