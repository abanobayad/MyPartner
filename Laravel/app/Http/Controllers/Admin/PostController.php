<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostAccepted;
use App\Notifications\PostRejected;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $selected_reps = $request->has('status') ? $request->get('status'):null;

        $posts = Post::orderBy('visible' , 'asc')->orderBy('updated_at' , 'desc')->paginate(10);
        // dd($posts);

        if($selected_reps != null){
            if($selected_reps == 'yes')  {$posts = Post::select()->where('visible' , 'yes')->paginate(10); }
            if($selected_reps == 'no')  {$posts = Post::select()->where('visible' , 'no')->paginate(10); }
        }

        return view('Admin.post.index' , compact('posts' , 'selected_reps'));
    }


    public function show($id)
    {
        $post = Post::find($id);
        return view('Admin.post.postnew' , compact('post'));
    }

    public function showPostRequests(Request $request  , $id)
    {

        $post = Post::find($id);
        // $requests = $post->requests()->paginate(10);

        $selected_reps = $request->has('status') ? $request->get('status'):null;

        $requests = $post->requests()->orderBy('status' , 'asc')->orderBy('updated_at' , 'desc')->paginate(10);
        // dd($requests);

        if($selected_reps != null){
            if($selected_reps == 'pending')  {$requests = $post->requests()->where('status' , 'pending')->paginate(10); }
            if($selected_reps == 'Acc')  {$requests = $post->requests()->where('status' , 'accept')->paginate(10); }
            if($selected_reps == 'Rej')  {$requests = $post->requests()->where('status' , 'reject')->paginate(10); }
        }

        return view('Admin.post.postRequests' , compact('post','requests','selected_reps'));
    }


}
