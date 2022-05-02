<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admin_id',
        'image',
    ];



    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class , 'cat_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }


    public function interests()
    {
     return $this->hasMany(Interest::class);
    }




    public function intrest_user()
    {
        return $this->belongsToMany(User::class , 'interests' , 'category_id' , 'user_id' );
    }



}
