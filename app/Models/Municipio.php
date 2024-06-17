<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    protected $fillable = ['nombre', 'seccional_id'];

    public function seccional()
    {
        return $this->belongsTo(Seccional::class, 'seccional_id');
    }

    public function parroquias()
    {
        return $this->hasMany(Parroquia::class, 'municipio_id');
    }
}
