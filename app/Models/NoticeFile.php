<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeFile extends Model
{
    use HasFactory;

    protected $fillable = ['notices_id', 'file_path'];

    public function notice()
    {
        return $this->belongsTo(Notices::class);
    }
}
