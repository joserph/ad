<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnextenItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'cedula',
        'nombre',
        'apellido',
        'num_telefono',
        'direccion',
        'centro_votacion',
        'onexten_id'
    ];
}
