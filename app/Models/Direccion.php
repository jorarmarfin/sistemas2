<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table = 'direccion';
    protected $fillable = [
        'persona_id',
        'departament',
        'province',
        'district',
        'direccion'
    ];
}
