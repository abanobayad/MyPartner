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
        $Courses = Category::create(['name' => 'Courses','image' => 'defult.jpg', 'admin_id' => 1]);
        $Entertaniment= Category::create(['name' => 'Entertaniment','image' => 'defult.jpg', 'admin_id' => 1]);
        $Food = Category::create(['name' => 'Food','image' => 'defult.jpg', 'admin_id' => 1]);

    //Tags
        $WebDevelopment = Tag::create(['name' => 'Web Development','image' => 'defult.jpg', 'admin_id' => 1]);
        $Backend =  Tag::create(['name' => 'Backend','image' => 'defult.jpg', 'admin_id' => 1]);
        $Frontend = Tag::create(['name' => 'Frontend','image'=> 'defult.jpg', 'admin_id' => 1]);

    //Groups

    $Laravel = Group::create(
        [
            'name' => 'Laravel' ,
            'description' => 'Laravel Group For Php Laravel' ,
            'admin_id' => '1' ,
            'category_id' => $Courses->id ,
            'image'=> 'defult.jpg',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );

    }
}
