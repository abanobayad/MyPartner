<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = ['post_id' , 'requester_id' , 'status'];

    public function requester()
    {
        return $this->belongsTo(User::class , 'requester_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class , 'post_id');
    }
}
