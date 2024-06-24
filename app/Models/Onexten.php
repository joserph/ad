<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onexten extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsable',
        'telefono',
        'seccional',
        'municipio',
        'parroquia',
        'sector',
    ];
}
