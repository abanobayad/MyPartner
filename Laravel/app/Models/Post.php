<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'location',
        'needed_persons',
        'price',
        'image',
        'user_id',
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function requests()
    {
        return $this->hasMany(Req::class, 'post_id');
    }



    public function reports()
    {
        return $this->hasMany(Report::class, 'post_id');
    }
}
