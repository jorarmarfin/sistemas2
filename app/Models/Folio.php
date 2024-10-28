<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;
    protected $table = 'folios';
    protected $fillable = [
        'fecha_inicio_id',
        'inicio',
        'consecutivo',
        'anio'
    ];
}
