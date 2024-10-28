<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MateriaPrecio;
use App\Models\Horarios;

class SolicitudDetalle extends Model
{
    use HasFactory;
    protected $table = 'detalle_solicitud';
    protected $fillable = [
        'solicitud_id',
        'horario_id',
        'promocion_id',
        'seccion_id'
    ];

    public function promocion()
    {
        return $this->hasOne(MateriaPrecio::class,'id','promocion_id');
    }

    public function horario()
    {
        return $this->hasOne(Horarios::class,'id','horario_id');
    }
	
}
