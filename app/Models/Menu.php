<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'id_padre',
        'id_permiso',
        'nombre',
        'alias',
        'ruta',
        'icono',
    ];
    public function permiso()
    {
        return $this->hasOne(Permission::class,'id','id_permiso');
    }
}
