<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'image',
        'comment_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(comment::class , 'comment_id');
    }
}
