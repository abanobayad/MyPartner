<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupVist extends Model
{
    use HasFactory;
    protected $table = 'group_visits';
    protected $fillable = ['user_id' , 'group_id'];


    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }


    public function groups()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
