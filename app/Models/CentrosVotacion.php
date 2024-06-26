<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentrosVotacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_centro',
        'tipo',
        'cod_estado',
        'cod_municipio',
        'cod_parroquia',
        'nombre_centro',
        'direccion_centro',
        'centro_nuevo',
    ];
}
