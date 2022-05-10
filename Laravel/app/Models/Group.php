<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;



class Group extends Model
{
    use SearchableTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'category_id',
        'admin_id',
    ];

    protected $searchable = [

        'columns' => [
            'groups.name'                => '10',
            'groups.description'         => '10',
            'categories.name'            => '10',
        ],
        'joins' =>
        [
            'categories' => ['groups.category_id','categories.id'],
        ],
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

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

    public function group_visits()
    {
        return $this->belongsToMany(User::class , 'group_visits' ,'group_id', 'user_id');
    }

    public function vists()
    {
        return $this->hasMany(GroupVist::class, 'group_id');
    }
}
