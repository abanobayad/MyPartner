<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\PostController;
use App\Models\Post;
use Illuminate\Http\Request;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//Users
$users=[];
$faker = Factory::create();
$gender = $faker->randomElement(['male', 'female']);

for ($i=0; $i < 20; $i++) {
    $users[$i] = User::create(
        [
            'name' => $faker->name($gender),
            'email' => $faker->safeEmail ,
            'password' =>  Hash::make('123456'),
        ]
    );
    $profile[$i] = Profile::create([
        'user_id' => $users[$i]->id,
        'phone' => $faker->phoneNumber,
        'gender' => $gender,
        'address' => $faker->address,
        'bio' => $faker->word,
        'image'    => 'user.png'
    ]);

    //post

    $post = Post::create(
        [
            'title' => 'Post',
            'content' => 'Post Content',
            'status' => 'pendding',
            'visble' => 'no',
            'needed_persons' => $faker->randomDigit ,
            'location' =>  $faker->url(),
            'price' =>  rand(200,2000),
            'user_id' =>  $users[$i]->id,
            'group_id' =>  rand(200,2000),
        ]
    );



}
// ***********************************************





    }
}
