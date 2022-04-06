<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason',
        'feedback',
        'post_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class , 'post_id');
    }
}
