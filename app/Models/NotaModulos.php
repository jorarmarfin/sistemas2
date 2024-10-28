<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaModulos extends Model
{
    use HasFactory;
    protected $table = 'nota_modulo';
    protected $fillable = [
        'nota_id',
        'modulo_id',
        'materia_id',
        'persona_id',
        'nota',
        'usuario_id'
    ];
}
