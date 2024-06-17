<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    use HasFactory;

    protected $table = 'comite';

    protected $with = ['members'];

    protected $fillable = [
        'nombre_comite',
    ];

    public function members()
    {
        return $this->hasMany(Members::class, 'comite_id');
    }
}
