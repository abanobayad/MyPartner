<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanceledRequest extends Model
{
    use HasFactory;
    protected $table = 'user_canceled_requests';
    protected $fillable = ['requester_id' , 'post_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'requester_id',);
    }
}
