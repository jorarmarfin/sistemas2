<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MateriaPrecio;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materia';
    protected $fillable = [
        'materia_id',
        'nombre',
        'alias',
        'dividir_seccion',
        'tipo',
        'estado',
        'materia_depende',
        'nota_minima'
    ];

    public function precios()
    {
        return $this->hasMany(MateriaPrecio::class,'materia_id','id');
    }
	
	public function modulos()
    {
        return $this->hasMany(Modulos::class,'id_materia','id');
    }

    public function scopeCantModulos($query, $id_materia){
        return $query->join('modulos','modulos.id_materia','=','materia.id')
                    ->where('modulos.id_materia','=', $id_materia)
                    ->count();
    }  
}
