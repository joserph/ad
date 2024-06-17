<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    use HasFactory;

    protected $with = ['noticeFiles'];

    protected $fillable = [
        'title',
        'link',
        'content',
        'main',
        'category_id',
        'media_path',
    ];

    public function noticeFiles()
    {
        return $this->hasMany(NoticeFile::class);
    }

    public function category()
    {
        return $this->hasOne(NoticeCategories::class, 'id', 'category_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($notice) {
            $notice->noticeFiles()->delete();
        });
    }
}
