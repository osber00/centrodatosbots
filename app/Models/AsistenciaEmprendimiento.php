<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaEmprendimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'identificacion',
        'telefono',
        'correo',
        'emprendimiento',
    ];
}
