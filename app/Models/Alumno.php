<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumno';
    protected $fillable = [
        'alumno_id',
        'persona_id',
        'solicitud_id',
        'ocupacion_id',
        'matricula',
        'numero',
        'estado',
        'nro_registro',
        'tipo',
        'matricula',
        'origen'
    ];
    public function persona()
    {
        return $this->hasOne(Persona::class,'id','persona_id');
    }
}
