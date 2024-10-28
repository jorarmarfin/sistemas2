<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

    protected $table = "mant_location";

    protected $fillable = [
        'name',
        'department_id',
        'province_id',
        'district_id',
        'status',
        'created_by',
        'last_updated_by',
    ];

}
