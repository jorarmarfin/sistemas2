<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;
    protected $table = 'horarios';
    protected $fillable = [
        'hora_inicio',
        'hora_termino',
        'nombre',
        'tipo',
        'estado'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];
}
