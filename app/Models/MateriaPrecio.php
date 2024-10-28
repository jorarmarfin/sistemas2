<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia;

class MateriaPrecio extends Model
{
    use HasFactory;
    protected $table = 'materia_precio';
    protected $fillable = [
        'materia_id',
        'nombre',
        'precio',
        'alias'
    ];
    public function materia()
    {
        return $this->hasOne(Materia::class,'id','materia_id');
    }
}
