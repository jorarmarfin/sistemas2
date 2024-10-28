<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SolicitudDetalle;
use App\Models\TipoDoc;
use App\Models\FechaInicio;
use App\Models\Alumno;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitud';
    protected $fillable = [
        'solicitud_id',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'id_documento',
        'ocupacion_id',
        'fecha_inicio_id',
        'documento',
        'telefono',
        'tipo',
        'correo',
        'sexo',
        'fecha_nacimiento',
        'archivo',
        'pais_id',
        'departament_id',
        'province_id',
        'district_id',
        'direccion',
        'nro_ficha',
        'apoderado_nombre',
        'apoderado_apellido',
        'apoderado_relacion',
        'apoderado_tipo_documento',
        'apoderado_documento',
        'apoderado_telefono',
        'apoderado_correo',
        'estado',
        'terminos_condiciones',
        'politicas',
        'alumno_id',
        'modalidad_facturacion',
        'ruc',
        'comentario'
    ];

    public function detalle_solicitud()
    {
        return $this->hasMany(SolicitudDetalle::class,'solicitud_id','id');
    }

    public function tipo_doc()
    {
        return $this->hasOne(TipoDoc::class,'id','id_documento');
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class,'solicitud_id','id');
    }

    public function fecha_inicio()
    {
        return $this->hasOne(FechaInicio::class,'id','fecha_inicio_id');
    }
}
