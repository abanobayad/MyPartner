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

        $posts = Post::orderBy('status' , 'asc')->orderBy('visible' , 'asc')->orderBy('updated_at' , 'desc')->paginate(10);
        // dd($posts);

        if($selected_reps != null){
            if($selected_reps == 'pendding'){$posts = Post::select()->where('status' , 'pending')->paginate(10);}
            if($selected_reps == 'accept')  {$posts = Post::select()->where('status' , 'accept')->paginate(10); }
            if($selected_reps == 'reject')  {$posts = Post::select()->where('status' , 'reject')->paginate(10); }
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





        //make post visbale and status accept , send notification to post owner
        public function approve($id){

            $post = Post::find($id);
            // dd($post->user()->first());
            $post->visible = 'yes';
            $post->status = 'accept';
            $post->save();


            $owner = User::find($post->user()->first()->id);

            $details = [
                'post_id' => $post->id,
                'title' => $post->title . ' Post has been Accepted',
                'body' => 'Your Post '.$post->title.' in ' . $post->group->name . ' group is Accepted',
            ];

            $owner->notify(new PostAccepted($details));

            return redirect(route('admin.post.index'));
        }

        //make post invisbale and status reject , send notification to post owner
        public function reject($id){
            $post = Post::find($id);
            $post->visible = 'no';
            $post->status = 'reject';
            $post->save();
            $owner = User::find($post->user()->first()->id);

            $details = [
                'post_id' => $post->id,
                'title' => $post->title . ' Post has been Rejected',
                'body' => 'Your Post '.$post->title.' in ' . $post->group->name . ' group is Rejected',
            ];

            $owner->notify(new PostRejected($details));

            return redirect(route('admin.post.index'));
        }

}
