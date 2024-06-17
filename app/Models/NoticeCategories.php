<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeCategories extends Model
{
    use HasFactory;

    protected $table = 'notice_categories';

    protected $fillable = [
        'name',
    ];
}
