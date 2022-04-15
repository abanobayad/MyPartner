<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rate;

class UserAController extends Controller
{
    public function index()
    {
        $data['users'] = User::select('id', 'name', 'email')->orderBy('id', 'desc')->get();
        return view('Admin.user.index')->with($data);
    }

    public function showUser($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->get();
        $rate = Rate::select()->where('receiver_id', $user->id)->get();
        $sum = 0;
        if($rate)
        {
            $total_rate = 'No Rates Yet';
        }
        else
        {
            foreach ($rate as $item) {$sum = $sum + $item->rate_value;   }
            $total_rate = $sum / sizeof($rate);
        }
        return view('Admin.user.profile.show', compact('user', 'total_rate' , 'posts'));
    }
}
