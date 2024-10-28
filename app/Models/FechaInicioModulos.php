<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia;

class FechaInicioModulos extends Model
{
    use HasFactory;
    protected $table = 'fecha_inicio_modulos';
    protected $fillable = [
        'fecha_inicio_id',
        'modulo_id',
        'horarios'
    ];

    public function materia()
    {
        return $this->hasOne(Materia::class,'id','modulo_id');
    }
}
