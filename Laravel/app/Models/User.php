<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'banned_till',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }



    public function posts()
    {
     return $this->hasMany(Post::class);
    }


    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }


    public function requests()
    {
        return $this->hasMany(Req::class, 'requester_id');
    }


    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'receiver_id');
    }


    public function SavedPosts()
    {
        return $this->hasMany(SavedPosts::class, 'user_id');
    }

    public function FavGroups()
    {
        return $this->hasMany(FavGroups::class, 'user_id');
    }


}
