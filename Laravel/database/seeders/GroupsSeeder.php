<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $PHP = Group::create(
        [
            'name' => 'PHP' ,
            'description' => 'PHP Group For Php PHP' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );


    $CSS = Group::create(
        [
            'name' => 'CSS' ,
            'description' => 'CSS Group For CSS CSS' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );


    $VSS = Group::create(
        [
            'name' => 'VSS' ,
            'description' => 'VSS Group For VSS VSS' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );

    $HTML = Group::create(
        [
            'name' => 'HTML' ,
            'description' => 'HTML Group For HTML HTML' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );


    $Flutter = Group::create(
        [
            'name' => 'Flutter' ,
            'description' => 'Flutter Group For Flutter Flutter' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );


    $React = Group::create(
        [
            'name' => 'React' ,
            'description' => 'React Group For React CSS' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );



    $Python = Group::create(
        [
            'name' => 'Python' ,
            'description' => 'Python Group For Python CSS' ,
            'admin_id' => 1 ,
            'category_id' => 1 ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );

    }
}
