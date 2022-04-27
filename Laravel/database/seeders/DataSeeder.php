<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Group;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //Cats
        $Courses = Category::create(['name' => 'Courses','image' => 'default.png', 'admin_id' => 1]);
        $Entertaniment= Category::create(['name' => 'Entertaniment','image' => 'default.png', 'admin_id' => 1]);
        $Food = Category::create(['name' => 'Food','image' => 'default.png', 'admin_id' => 1]);

    //Tags
        $WebDevelopment = Tag::create(['name' => 'Web Development','image' => 'default.png', 'admin_id' => 1]);
        $Backend =  Tag::create(['name' => 'Backend','image' => 'default.png', 'admin_id' => 1]);
        $Frontend = Tag::create(['name' => 'Frontend','image'=> 'default.png', 'admin_id' => 1]);

    //Groups

    $Laravel = Group::create(
        [
            'name' => 'Laravel' ,
            'description' => 'Laravel Group For Php Laravel' ,
            'admin_id' => '1' ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );

    }
}
