<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'groups_count' => Group::all()->count(),
            'categories_count' => Category::all()->count(),
            'tags_count' => Category::all()->count(),
            'users_count' => User::all()->count(),
            'groups' => Group::select()->take(3)->get(),
            'categories' => Category::select()->take(3)->get(),
            'tags' => Tag::select()->take(3)->get(),
            'users' => User::select()->take(3)->get(),
        ];

        return view('Admin.index', compact('data'));
    }
}
