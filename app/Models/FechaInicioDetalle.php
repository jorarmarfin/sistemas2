<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horarios;
use App\Models\FechaInicio;

class FechaInicioDetalle extends Model
{
    use HasFactory;
    protected $table = 'detalle_fecha_inicio';
    protected $fillable = [
        'fecha_inicio_id',
        'horario_id'
    ];

    public function horario()
    {
        return $this->hasOne(Horarios::class,'id','horario_id');
    }

    public function fecha_inicio()
    {
        return $this->hasOne(FechaInicio::class,'id','fecha_inicio_id');
    }
}
