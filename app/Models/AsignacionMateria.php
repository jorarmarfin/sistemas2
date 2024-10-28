<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Calificaciones;

class AsignacionMateria extends Model
{
    use HasFactory;
    protected $table = 'asignacion_materia';

    protected $fillable = [
        'materia_id',
        'persona_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function alumnos()
    {
        return $this->hasMany(Calificaciones::class,'materia_id','materia_id');
    }
}
