<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaArchivo extends Model
{
    use HasFactory;
    protected $table = 'carga_archivo';
    protected $fillable = [
        'usuario_id',
    ];
}
