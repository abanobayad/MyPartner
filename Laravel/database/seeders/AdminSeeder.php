<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(
            [
                'name' => '3edo',
                'email' => '3edo@3edo.com',
                'password' => bcrypt('123456'),
                'image' => '',
                'password' => bcrypt('123456'),
            ]
        );
        Admin::create(
            [
                'name' => 'Youssef',
                'email' => 'jo@jo.com',
                'image' => '',
                'password' => bcrypt('123456'),
            ]
        );
        Admin::create(
            [
                'name' => 'Rowan',
                'email' => 'ro@ro.com',
                'image' => '',
                'password' => bcrypt('123456'),
            ]
        );
    }
}
