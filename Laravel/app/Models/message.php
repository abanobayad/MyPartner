<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'body',
        'attachment',
        'seen',
        'v_user1',
        'v_user2',
        'chat_id'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class , 'sender_id');
    }


    public function chat()
    {
        return $this->belongsTo(chat::class , 'chat_id');
    }



}
