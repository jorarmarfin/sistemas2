<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horarios;

class MateriaHorario extends Model
{
    use HasFactory;
    protected $table = 'materia_horario';
    protected $fillable = [
        'materia_id',
        'horario_id'
    ];
    public function horario()
    {
        return $this->hasOne(Horarios::class,'id','horario_id');
    }
}
