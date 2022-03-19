<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    use HasFactory  ,  Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];


    public function categoires()
    {
        return $this->hasMany(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

}
