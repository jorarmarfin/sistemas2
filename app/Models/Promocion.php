<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetallePromocion;
use App\Models\Materia;

class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promociones';
    protected $fillable = [
        'nombre',
        'p_completo',
        'precio',
        'p_becario',
        'tipo',
        'estado',
        'materia_id'
    ];

    public function horarios()
    {
        return $this->hasMany(DetallePromocion::class,'promocion_id','id');
    }

    public function materia()
    {
        return $this->hasOne(Materia::class,'id','materia_id');
    }
}
