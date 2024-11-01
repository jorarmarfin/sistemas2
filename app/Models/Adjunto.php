<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;
    protected $table = 'adjuntos';
    protected $fillable = [
        'persona_id',
        'nombre',
        'ruta',
        'tipo',
        'estado',
        'comentario'
    ];
}
