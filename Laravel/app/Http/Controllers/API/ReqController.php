<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostRequested;
use App\Models\Req;

class ReqController extends BaseController
{
    public function index()
    {
        $arr = [];
        $user_id = Auth::user()->id;
        $user = User::select('id' , 'name')->where('id', $user_id)->get();
        $Requests = Req::select()->where('post_owner_id' , $user_id)->get();

        foreach ($Requests as $req) {
            array_push($arr ,
            [
            'reqeusted_post' =>$req->post()->select('id','title')->get(),
            'requester' =>$req->user()->select('id','name')->get(),
            'status' => $req->status
        ]);
        }


        $data = ['User' =>$user ,'Requests' =>$arr];
        return $this->SendResponse($data , "Requests sent");
    }


    public function doReq(Request $request)
    {

        $old_req = DB::table('requests')->where('post_id', $request->post_id)->where('requester_id', Auth::user()->id)->get();
        $post = Post::find($request->post_id);
        $user = User::find($post->user_id);
        // dd($user->id);

        if($post->user_id == Auth::id())
        {
            return $this->SendError('You Cannot Request Your Posts');
        }

        $group = $post->group;
        $reqester = User::find(Auth::user()->id);


        if (count($old_req) == 0) //check duplicate
        {
            DB::table('requests')->insert([
                    'post_id' => $request->post_id,
                    'post_owner_id' => $user->id,
                    'requester_id' => Auth::user()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);


            $details = [
                'post_id' => $post->id,
                'requester_id' => Auth::user()->id,
                'title' => $post->title . ' post requested',
                'body' => 'Your post in ' . $group->name . ' group is requested by ' . $reqester->name,
            ];
            $user->notify(new PostRequested($details));


            return $this->SendResponse($details, 'Post Requested successfully');
        } else {

            return $this->SendError('You Request Before');
        }
    }

    public function showReq($post_id, $req_id)
    {
        $req = Req::where('post_id', $post_id)->where('requester_id', $req_id)->first();
        return view('frontend.showRequest', compact('req'));
    }

    public function approveRequest($post_id, $requester_id)
    {
        // DB::table('course_student')->where('student_id',$id)->where('course_id', $c_id)->update(['status'=>'approve']);
        DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->update(['status' => 'accept']);
        return back();
    }

    public function rejectRequest($post_id, $requester_id)
    {
        // DB::table('course_student')->where('student_id',$id)->where('course_id', $c_id)->update(['status'=>'approve']);
        DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->update(['status' => 'reject']);
        return back();
    }

    public function deleteRequest($post_id, $requester_id)
    {
        // DB::table('course_student')->where('student_id',$id)->where('course_id', $c_id)->update(['status'=>'approve']);
        DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->delete();
        return back();
    }
}
