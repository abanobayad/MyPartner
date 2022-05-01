<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Group;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



     //Admins

    $abanob =  Admin::create(
        [
            'name' => '3edo',
            'email' => '3edo@3edo.com',
            'password' => bcrypt('123456'),
            'image' => 'default.png',
            'password' => bcrypt('123456'),
        ]
    );
    Admin::create(
        [
            'name' => 'Youssef',
            'email' => 'jo@jo.com',
            'image' => 'default.png',
            'password' => bcrypt('123456'),
        ]
    );
    Admin::create(
        [
            'name' => 'Rowan',
            'email' => 'ro@ro.com',
            'image' => 'default.png',
            'password' => bcrypt('123456'),
        ]
    );


    //Cats
        $Courses = Category::create(['name' => 'Courses','image' => 'default.png', 'admin_id' => $abanob->id]);
        $Entertaniment= Category::create(['name' => 'Entertaniment','image' => 'default.png', 'admin_id' => $abanob->id]);
        $Food = Category::create(['name' => 'Food','image' => 'default.png', 'admin_id' => $abanob->id]);

    //Tags
        $WebDevelopment = Tag::create(['name' => 'Web Development','image' => 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $MobileDevelopment = Tag::create(['name' => 'Mobile Development','image' => 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $Backend =  Tag::create(['name' => 'Backend','image' => 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $Frontend = Tag::create(['name' => 'Frontend','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $AI = Tag::create(['name' => 'AI','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $MachineLearning = Tag::create(['name' => 'Machine Learning','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $Security = Tag::create(['name' => 'Security','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);
        $Network = Tag::create(['name' => 'Network','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Courses->id]);

        $FastFood = Tag::create(['name' => 'Fast Food','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Food->id]);
        $EgFood = Tag::create(['name' => 'مأكولات مصرية','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Food->id]);
        $SyFood = Tag::create(['name' => 'مأكولات سورية','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Food->id]);



        $WatchApps = Tag::create(['name' => 'Watching Apps','image'=> 'default.png', 'admin_id' => $abanob->id , 'cat_id' => $Entertaniment->id]);



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
    $Laravel->tags()->attach([$Backend->id,$WebDevelopment->id]);


    $PHP = Group::create(
        [
            'name' => 'PHP' ,
            'description' => 'PHP Group For Php PHP' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $PHP->tags()->attach([$Backend->id,$WebDevelopment->id]);


    $CSS = Group::create(
        [
            'name' => 'CSS' ,
            'description' => 'CSS Group For CSS CSS' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );

    $CSS->tags()->attach([$Frontend->id,$WebDevelopment->id]);

    $CCNA = Group::create(
        [
            'name' => 'VSS' ,
            'description' => 'VSS Group For VSS VSS' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $CCNA->tags()->attach([$Network->id,$Security->id]);

    $HTML = Group::create(
        [
            'name' => 'HTML' ,
            'description' => 'HTML Group For HTML HTML' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $HTML->tags()->attach([$Frontend->id,$WebDevelopment->id]);


    $Flutter = Group::create(
        [
            'name' => 'Flutter' ,
            'description' => 'Flutter Group For Flutter Flutter' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $Flutter->tags()->attach([$Frontend->id,$MobileDevelopment->id]);


    $React = Group::create(
        [
            'name' => 'React' ,
            'description' => 'React Group For React CSS' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $React->tags()->attach([$Frontend->id,$WebDevelopment->id]);



    $Python = Group::create(
        [
            'name' => 'Python' ,
            'description' => 'Python Group For Python CSS' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Courses->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $Python->tags()->attach([$AI->id,$MachineLearning->id]);


    //Food Groups

    $KFC = Group::create(
        [
            'name' => 'KFC' ,
            'description' => 'KFC Group For KFC Resturant' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Food->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $KFC->tags()->attach([$FastFood->id]);

    $MacDonalds = Group::create(
        [
            'name' => 'MacDonalds' ,
            'description' => 'MacDonalds Group For MacDonalds Resturant' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Food->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $MacDonalds->tags()->attach([$FastFood->id]);



    $BeboRes = Group::create(
        [
            'name' => 'مشويات بيبو' ,
            'description' => 'مشويات بيبو Group For مشويات بيبو Resturant' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Food->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $BeboRes->tags()->attach([$FastFood->id,$EgFood->id]);


    $BoMazen = Group::create(
        [
            'name' => 'ابو مازن السوري' ,
            'description' => 'ابو مازن السوري Group For ابو مازن السوري Resturant' ,
            'admin_id' => $abanob->id ,
            'category_id' => $Food->id ,
            'image'=> 'default.png',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]
    );
    $BoMazen->tags()->attach([$FastFood->id,$SyFood->id]);


//entertainment

$watchit = Group::create(
    [
        'name' => 'WatchIt' ,
        'description' => 'WatchIt Group For WatchIt App' ,
        'admin_id' => $abanob->id ,
        'category_id' => $Entertaniment->id ,
        'image'=> 'default.png',
        'created_at'=> now(),
        'updated_at'=> now(),
    ]
);
$watchit->tags()->attach([$WatchApps->id]);




    }
}
