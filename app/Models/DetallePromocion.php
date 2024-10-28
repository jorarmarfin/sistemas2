<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horarios;
use App\Models\Promocion;

class DetallePromocion extends Model
{
    use HasFactory;
    protected $table = 'detalle_promociones';
    protected $fillable = [
        'promocion_id',
        'horario_id'
    ];

    public function horario()
    {
        return $this->hasOne(Horarios::class,'id','horario_id');
    }

    public function promocion()
    {
        return $this->hasOne(Promocion::class,'id','promocion_id');
    }
}
