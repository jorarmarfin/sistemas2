<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia;
use App\Models\Persona;

class Notas extends Model
{
    use HasFactory;
    protected $table = 'notas';
    protected $fillable = [
        'fecha_inicio_id',
        'modulo_id',
        'solicitud_id',
        'seccion_id',
        'persona_id',
        'nota',
        'usuario_id'
    ];

    public function materia()
    {
        return $this->hasOne(Materia::class,'id','modulo_id');
    }

    public function persona()
    {
        return $this->hasOne(Persona::class,'id','persona_id');
    }
}
