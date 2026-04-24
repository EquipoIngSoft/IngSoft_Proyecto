<?php
namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';
    protected $primaryKey = 'id_factura';
    public $timestamps = false;
}