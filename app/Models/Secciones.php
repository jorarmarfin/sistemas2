<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FechaInicio;
use App\Models\FechaInicioDetalle;
use App\Models\Notas;

class Secciones extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = [
        'nombre',
        'cantidad_alumnos',
        'url_classrom',
		'codigo_clase',
        'url_instructivo',
        'fecha_termino',
        'fecha_inicio_id',
        'numero_seccion',
        'modulo_id',
        'horario_id',
        'promocion_id'
    ];

    public function fecha_inicio()
    {
        return $this->hasOne(FechaInicio::class,'id','fecha_inicio_id');
    }

    public function detalle_fecha()
    {
        return $this->hasOne(FechaInicioDetalle::class,'fecha_inicio_id','fecha_inicio_id');
    }

    public function notas()
    {
        return $this->hasMany(Notas::class,'seccion_id','id');
    }
	public function scopeValAlumnos($query){
        return $query->join('notas','notas.seccion_id','=','secciones.id')
                    ->count();
    }

    public function scopeCantAlumn($query, $seccion_id){
        return $query->join('notas','notas.seccion_id','=','secciones.id')
                    ->join('persona','persona.id','=','notas.persona_id')
                    ->where('notas.seccion_id','=',$seccion_id)
                    ->distinct('persona.id')
                    ->count();
    }

    public function scopeNotasAlumnos($query, $seccion_id)
    {
        return $query->select('persona.apellidos','persona.nombres','persona.documento','persona.id_documento','tipo_doc.nombre as documento_nombre')
                    ->join('notas','notas.seccion_id','=','secciones.id')
                    ->join('persona','persona.id','=','notas.persona_id')
                    ->leftJoin('tipo_doc','tipo_doc.id','=','persona.id_documento')
                    ->where('notas.seccion_id','=',$seccion_id)
                    ->distinct('persona.id')
                    ->get();
    }
}
