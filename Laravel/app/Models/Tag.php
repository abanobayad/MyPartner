<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'admin_id',
        'image',
    ];


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class , 'groups_tags'  , 'tag_id' , 'group_id' );
    }
}
