<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gasto extends Model
{
    use HasFactory;

    // 👇 Agrega aquí los campos que puedes asignar masivamente
    protected $fillable = [
        'fecha',
        'monto',
        'descripcion',
    ];
}
