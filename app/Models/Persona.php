<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoDoc;
use App\Models\Alumno;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona';
    protected $fillable = [
        'nombres',
        'apellidos',
        'id_documento',
        'documento',
        'telefono',
        'tipo',
        'sexo',
        'id_usaurio',
        'correo',
        'fecha_nacimiento'
    ];

    public function tipo_doc()
    {
        return $this->hasOne(TipoDoc::class,'id','id_documento');
    }
    public function alumno()
    {
        return $this->hasOne(Alumno::class,'persona_id','id');
    }
}
