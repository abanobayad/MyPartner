<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Group;
use App\Models\Post;
use App\Models\Rate;
use App\Models\Report;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'groups_count'      => Group::all()->count(),
            'categories_count'  => Category::all()->count(),
            'tags_count'        => Tag::all()->count(),
            'users_count'       => User::all()->count(),
            'reports_count'     => Report::all()->count(),
            'contacts_count'       => Contact::all()->count(),
            'posts_count'           => Post::all()->count(),
            'groups'            => Group::select()->latest('updated_at')->take(3)->get(),
            'categories'        => Category::select()->latest('updated_at')->take(3)->get(),
            'tags'              => Tag::select()->latest('updated_at')->take(3)->get(),
            'users'             => User::select()->latest('updated_at')->take(3)->get(),
            'not_h_reports'           => Report::select()->where('is_handled' , 'no')->get(),
            'h_reports'           => Report::select()->where('is_handled' , 'yes')->get(),
            'contacts'             => Contact::select()->latest('updated_at')->take(3)->get(),
            'posts'             => Post::select()->latest('updated_at')->take(3)->get(),


        ];

        return view('Admin.index', compact('data'));
    }
}
