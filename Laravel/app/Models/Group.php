<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'category_id',
        'admin_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'groups_tags' , 'group_id' , 'tag_id' );
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
