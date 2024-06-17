<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccional extends Model
{
    use HasFactory;

    protected $table = 'seccionales';

    protected $fillable = ['nombre'];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'seccional_id');
    }
}
