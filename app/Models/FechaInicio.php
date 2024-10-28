<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia;
use App\Models\FechaInicioDetalle;
use App\Models\FechaInicioModulos;

class FechaInicio extends Model
{
    use HasFactory;
    protected $table = 'fecha_inicio';
    protected $fillable = [
        'f_inicio',
        'f_limite',
        'f_cierre',
        'cantidad_alumno',
        'nombre',
        'estado'
    ];
    public function modulo()
    {
        return $this->hasOne(Materia::class,'id','modulo_id');
    }

    public function horarios()
    {
        return $this->hasMany(FechaInicioDetalle::class,'id','fecha_inicio_id');
    }

    public function modulos()
    {
        return $this->hasMany(FechaInicioModulos::class,'fecha_inicio_id','id');
    }

    public function scopeCantidadInscritos($query,$materia_id,$fecha_inicio_id){
        return $query->join('solicitud','solicitud.fecha_inicio_id','=','fecha_inicio.id')
                    ->join('detalle_solicitud','detalle_solicitud.solicitud_id','=','solicitud.id')
                    ->join('materia_precio','materia_precio.id','=','detalle_solicitud.promocion_id')
                    ->where([
                        ['fecha_inicio.id','=',$fecha_inicio_id],
                        ['materia_precio.materia_id','=',$materia_id]
                    ])
                    ->count();
    }

    public function scopeRegistrosValidados($query,$materia_id,$fecha_inicio_id){
        return $query->join('solicitud','solicitud.fecha_inicio_id','=','fecha_inicio.id')
                    ->join('detalle_solicitud','detalle_solicitud.solicitud_id','=','solicitud.id')
                    ->join('materia_precio','materia_precio.id','=','detalle_solicitud.promocion_id')
                    ->where([
                        ['fecha_inicio.id','=',$fecha_inicio_id],
                        ['solicitud.estado','=','validado'],
                        ['materia_precio.materia_id','=',$materia_id]
                    ])
                    ->count();
    }

    public function scopeRegistrosNoValidados($query,$materia_id,$fecha_inicio_id){
        return $query->join('solicitud','solicitud.fecha_inicio_id','=','fecha_inicio.id')
                    ->join('detalle_solicitud','detalle_solicitud.solicitud_id','=','solicitud.id')
                    ->join('materia_precio','materia_precio.id','=','detalle_solicitud.promocion_id')
                    ->where([
                        ['fecha_inicio.id','=',$fecha_inicio_id],
                        ['solicitud.estado','=','pendiente'],
                        ['materia_precio.materia_id','=',$materia_id]
                    ])
                    ->count();
    }

    public function scopeRegistrosRechazados($query,$materia_id,$fecha_inicio_id){
        return $query->join('solicitud','solicitud.fecha_inicio_id','=','fecha_inicio.id')
                    ->join('detalle_solicitud','detalle_solicitud.solicitud_id','=','solicitud.id')
                    ->join('materia_precio','materia_precio.id','=','detalle_solicitud.promocion_id')
                    ->where([
                        ['fecha_inicio.id','=',$fecha_inicio_id],
                        ['solicitud.estado','=','rechazado'],
                        ['materia_precio.materia_id','=',$materia_id]
                    ])
                    ->count();
    }
}
