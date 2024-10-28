<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $fillable = [
        'persona_id',
        'materia_id',
        'profesor_id',
        'calificacion'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];
}
