<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Group;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Report;
use App\Models\Req;
use App\Models\Tag;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Schema::enableForeignKeyConstraints();

        //Admins

        $abanob =  Admin::create(
            [
                'name' => 'Abanob',
                'email' => '3edo@3edo.com',
                'password' => bcrypt('123456'),
                'image' => 'abanob.jpg',
                'password' => bcrypt('123456'),
            ]
        );

        Admin::create(
            [
                'name' => 'Youssef',
                'email' => 'jo@jo.com',
                'image' => 'youssef.jpg',
                'password' => bcrypt('123456'),
            ]
        );



        //Cats
        $Courses = Category::create(['name' => 'Courses', 'image' => 'course.jpg', 'admin_id' => $abanob->id]);
        $Entertaniment = Category::create(['name' => 'Entertaniment', 'image' => 'entertainment.jpg', 'admin_id' => $abanob->id]);
        $Food = Category::create(['name' => 'Food', 'image' => 'food.jpg', 'admin_id' => $abanob->id]);
        $Sport = Category::create(['name' => 'Sport', 'image' => 'sport.png', 'admin_id' => $abanob->id]);

        //Tags
        $WebDevelopment = Tag::create(['name' => 'Web Development', 'image' => 'web.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $MobileDevelopment = Tag::create(['name' => 'Mobile Development', 'image' => 'mobile.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $Backend =  Tag::create(['name' => 'Backend', 'image' => 'backend.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $Frontend = Tag::create(['name' => 'Frontend', 'image' => 'frontend.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $AI = Tag::create(['name' => 'AI', 'image' => 'ai.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $MachineLearning = Tag::create(['name' => 'Machine Learning', 'image' => 'ml.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $Security = Tag::create(['name' => 'Security', 'image' => 'sec.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $Network = Tag::create(['name' => 'Network', 'image' => 'network.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);
        $CISCO = Tag::create(['name' => 'CISCO', 'image' => 'cisco.png', 'admin_id' => $abanob->id, 'cat_id' => $Courses->id]);

        $FastFood = Tag::create(['name' => 'Fast Food', 'image' => 'fastfood.png', 'admin_id' => $abanob->id, 'cat_id' => $Food->id]);
        $Cafeshop = Tag::create(['name' => 'Coffee Shop', 'image' => 'cafe.png', 'admin_id' => $abanob->id, 'cat_id' => $Food->id]);
        $Bakery = Tag::create(['name' => 'Bakery', 'image' => 'bake.png', 'admin_id' => $abanob->id, 'cat_id' => $Food->id]);
        $EgFood = Tag::create(['name' => 'مأكولات مصرية', 'image' => 'egfood.png', 'admin_id' => $abanob->id, 'cat_id' => $Food->id]);
        $SyFood = Tag::create(['name' => 'مأكولات سورية', 'image' => 'syfood.png', 'admin_id' => $abanob->id, 'cat_id' => $Food->id]);



        $WatchApps = Tag::create(['name' => 'Movies Applications', 'image' => 'watchapp.jpg', 'admin_id' => $abanob->id, 'cat_id' => $Entertaniment->id]);

        $Gym = Tag::create(['name' => 'Gym', 'image' => 'gym.png', 'admin_id' => $abanob->id, 'cat_id' => $Food->id]);

        //Groups

        $Laravel = Group::create(
            [
                'name' => 'Laravel',
                'description' => 'Laravel Group For Php Laravel',
                'admin_id' => '1',
                'category_id' => $Courses->id,
                'image' => 'laravel.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $Laravel->tags()->attach([$Backend->id, $WebDevelopment->id]);


        $PHP = Group::create(
            [
                'name' => 'PHP',
                'description' => 'PHP Group For Php Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'php.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $PHP->tags()->attach([$Backend->id, $WebDevelopment->id]);


        $CSS = Group::create(
            [
                'name' => 'CSS',
                'description' => 'CSS Group For CSS Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'css.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $CSS->tags()->attach([$Frontend->id, $WebDevelopment->id]);

        $CCNA = Group::create(
            [
                'name' => 'CCNA',
                'description' => 'CCNA Group For CCNA Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'CCNA.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $CCNA->tags()->attach([$CISCO->id, $Network->id, $Security->id]);


        $HCIA = Group::create(
            [
                'name' => 'HCIA',
                'description' => 'HCIA Group For HCIA Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'HCIA.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $HCIA->tags()->attach([$Network->id, $Security->id]);



        $HTML = Group::create(
            [
                'name' => 'HTML',
                'description' => 'HTML Group For HTML Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'html.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $HTML->tags()->attach([$Frontend->id, $WebDevelopment->id]);


        $Flutter = Group::create(
            [
                'name' => 'Flutter',
                'description' => 'Flutter Group For Flutter Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'flutter.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $Flutter->tags()->attach([$Frontend->id, $MobileDevelopment->id]);


        $React = Group::create(
            [
                'name' => 'React',
                'description' => 'React Group For React JS Lovers',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'react.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $React->tags()->attach([$Frontend->id, $WebDevelopment->id]);



        $Python = Group::create(
            [
                'name' => 'Python',
                'description' => 'Python Group For Python CSS',
                'admin_id' => $abanob->id,
                'category_id' => $Courses->id,
                'image' => 'python.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $Python->tags()->attach([$AI->id, $MachineLearning->id]);


        //Food Groups

        $KFC = Group::create(
            [
                'name' => 'KFC',
                'description' => 'KFC Group For KFC Resturant',
                'admin_id' => $abanob->id,
                'category_id' => $Food->id,
                'image' => 'kfc.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $KFC->tags()->attach([$FastFood->id]);

        $MacDonalds = Group::create(
            [
                'name' => 'MacDonalds',
                'description' => 'MacDonalds Group For MacDonalds Resturant',
                'admin_id' => $abanob->id,
                'category_id' => $Food->id,
                'image' => 'mac.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $MacDonalds->tags()->attach([$FastFood->id]);


        $Starbuks = Group::create(
            [
                'name' => 'Starbucks',
                'description' => 'Starbucks Group For Starbucks Resturant',
                'admin_id' => $abanob->id,
                'category_id' => $Food->id,
                'image' => 'starbucks.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $Starbuks->tags()->attach([$Cafeshop->id]);


        $cenabon = Group::create(
            [
                'name' => 'Cenabon',
                'description' => 'Cenabon Group For Cenabon Resturant',
                'admin_id' => $abanob->id,
                'category_id' => $Food->id,
                'image' => 'cenabon.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $cenabon->tags()->attach([$Bakery->id]);





        $BeboRes = Group::create(
            [
                'name' => 'مشويات بيبو',
                'description' => ' مشويات بيبو للأكل المصري الاصيل',
                'admin_id' => $abanob->id,
                'category_id' => $Food->id,
                'image' => 'bebo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $BeboRes->tags()->attach([$FastFood->id, $EgFood->id]);


        $BoMazen = Group::create(
            [
                'name' => 'ابو مازن السوري',
                'description' => 'ابو مازن السوري للأكل السوري الاصيل',
                'admin_id' => $abanob->id,
                'category_id' => $Food->id,
                'image' => 'bomazen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $BoMazen->tags()->attach([$FastFood->id, $SyFood->id]);


        //entertainment

        $watchit = Group::create(
            [
                'name' => 'WatchIt',
                'description' => 'WatchIt Group For WatchIt App',
                'admin_id' => $abanob->id,
                'category_id' => $Entertaniment->id,
                'image' => 'watchit.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $watchit->tags()->attach([$WatchApps->id]);


        $netflix = Group::create(
            [
                'name' => 'Netflix',
                'description' => 'Netflix Group For Netflix App',
                'admin_id' => $abanob->id,
                'category_id' => $Entertaniment->id,
                'image' => 'netflix.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $netflix->tags()->attach([$WatchApps->id]);


        $shahid = Group::create(
            [
                'name' => 'Shahid',
                'description' => 'Shahid Group For Shahid App',
                'admin_id' => $abanob->id,
                'category_id' => $Entertaniment->id,
                'image' => 'shahid.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $shahid->tags()->attach([$WatchApps->id]);

        $bein = Group::create(
            [
                'name' => 'Bein Sports',
                'description' => 'Bein Sports Group For Bein Sports App',
                'admin_id' => $abanob->id,
                'category_id' => $Entertaniment->id,
                'image' => 'bein.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $bein->tags()->attach([$WatchApps->id]);




        //Sports

        $golds = Group::create(
            [
                'name' => 'Golds Gym',
                'description' => 'Golds Gym Group For Golds Clients',
                'admin_id' => $abanob->id,
                'category_id' => $Sport->id,
                'image' => 'golds.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $golds->tags()->attach([$Gym->id]);


        //------------------------------------------------------------------------------

        //Users
        $users = [];
        $posts = [];
        $faker = Factory::create();
        $gender = $faker->randomElement(['male', 'female']);
        $groups = [$Laravel, $React, $golds, $bein, $BeboRes, $BoMazen, $watchit, $cenabon, $netflix, $Starbuks, $CCNA, $CSS, $Flutter, $HCIA, $HTML, $KFC, $MacDonalds, $PHP, $Python, $shahid];

        for ($i = 0; $i < 20; $i++) {
            $users[$i] = User::create(
                [
                    'name' => $faker->name($gender),
                    'email' => $faker->safeEmail,
                    'password' =>  Hash::make('123456'),
                ]
            );
            $profile[$i] = Profile::create([
                'user_id' => $users[$i]->id,
                'phone' => $faker->phoneNumber,
                'gender' => $gender,
                'address' => $faker->address,
                'bio' => $faker->word,
                'image'    => 'u.png'
            ]);

            //post
            $group = $groups[array_rand($groups, 1)];
            $posts[$i] = Post::create(
                [
                    'title' => $group->name . ' Post',
                    'content' => $group->name . ' Post Content',
                    'visible' => 'yes',
                    'needed_persons' => rand(1, 10),
                    'location' =>  $faker->url(),
                    'price' =>  rand(200, 2000),
                    'user_id' =>  $users[$i]->id,
                    'group_id' =>  $group->id,
                ]
            );

            $res = ['Create New Group', 'Create New Category', 'other'];
            $contacts[$i] = Contact::create(
                [
                    'subject' => $faker->word,
                    'content' => $faker->text($maxNbChars = 50),
                    'reason' => $res[array_rand($res, 1)],
                    'user_id' => $users[$i]->id,
                ]
            );

            $p = $posts[array_rand($posts , 1)];
            $requests[$i] = Req::create(
                [
                    'post_id' => $p->id,
                    'post_owner_id' => $p->user_id,
                    'requester_id' => $users[$i]->id,
                    'status' => 'pending' ,
                ]
            );
        }
    }
}
