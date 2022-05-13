<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rate;
use App\Models\Post;

class UserAController extends Controller
{
    public function index()
    {
        $data['users'] = User::select('id', 'name', 'email')->orderBy('id', 'desc')->paginate(10);
        return view('Admin.user.index')->with($data);
    }

    public function showUser($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->paginate(6);
        $rate = Rate::select()->where('receiver_id', $user->id)->get();
        // dd($rate->count());
        $sum = 0;
        if($rate->count() ==0)
        {
            $total_rate = 'No Rates Yet';
        }
        else
        {
            foreach ($rate as $item) {$sum = $sum + $item->rate_value;   }
            $total_rate = $sum / sizeof($rate);
        }
        return view('Admin.user.profile.show', compact('user','rate' ,'total_rate' , 'posts'));
    }

    public function search(Request $request , $user_id)
    {
         $request->validate(['q' => 'required|string']);
            $q = $request->q;
            $filteredPosts = Post::
                  where([['user_id' , $user_id],['title' , 'like' , '%'. $q .'%'],])
                ->orWhere([['user_id' , $user_id],['content' , 'like' , '%'. $q .'%']])
                    ->paginate(4);


        //  dd($filteredPosts->count());
        if($filteredPosts->count() != 0)
        {
            $status = 'success';
        return view('admin.user.profile.userSearchResult' , compact('filteredPosts' , 'status'));
        }
        else
        {
        return view('admin.user.profile.userSearchResult')->with(
            [
                'status' => 'fail',
                'message' =>'Your input doesn\'t match any post ',
            ]
        );
        }
    }

}
