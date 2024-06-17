<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    use HasFactory;

    public static function getOptions()
    {
        return [
            'nacional' => __('Nacional'),
            'seccional' => __('Seccional'),
            'municipal' => __('Municipal'),
            'parroquial' => __('Parroquial'),
        ];
    }
}
