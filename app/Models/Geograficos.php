<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geograficos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cod_estado',
        'cod_municipio',
        'cod_parroquia',
        'estado',
        'municipio',
        'parroquia',
    ];
}
