<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'fecha_nacimiento',
        'profesion',
        'red_social',
        'usuario_red',
        'genero',
        'alcance',
        'seccional',
        'municipio',
        'parroquia',
        'tipo_cargo',
        'cargo',
        'buro',
        'cargo_pub',
        'comite_id',
        'direccion',
        // 'password',
        // 'confirm_password',
    ];
}
