<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    public static function getSocialNet()
    {
        return [
            'facebook' => __('Facebook'),
            'instagram' => __('Instagram'),
            'twitter' => __('Twitter'),
        ];
    }
}
