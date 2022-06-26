<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\CanceledRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostRequested;
use App\Models\Req;
use App\Notifications\RequestAccepted;
use App\Notifications\RequestCanceled;
use App\Notifications\RequestRejected;

class ReqController extends BaseController
{
    public function index()
    {
        $arr = [];
        $user_id = Auth::user()->id;
        $user = User::select('id', 'name')->where('id', $user_id)->get();
        $Requests = Req::select()->where('post_owner_id', $user_id)->get();
        $req_no = $Requests->count();

        if ($req_no == 0)
            return $this->SendError('No Requests');
        foreach ($Requests as $req) {
            array_push(
                $arr,
                [
                    'reqeusted_post' => $req->post()->select('id', 'title')->get(),
                    'requester' => $req->requester()->select('id', 'name')->get(),
                    'status' => $req->status
                ]
            );
        }


        $data = ['User' => $user, 'No_of_requests' => $req_no, 'Requests' => $arr];
        return $this->SendResponse($data, "Requests sent");
    }

    public function showPending()
    {
        $arr = [];
        $user_id = Auth::user()->id;
        $user = User::select('id', 'name')->where('id', $user_id)->get();
        $Requests = Req::select()->where('post_owner_id', $user_id)->where('status', 'pending')->get();
        $req_no = $Requests->count();

        if ($req_no == 0)
            return $this->SendError('No Requests');

        foreach ($Requests as $req) {
            array_push(
                $arr,
                [
                    'reqeusted_post' => $req->post()->select('id', 'title')->get(),
                    'requester' => $req->requester()->select('id', 'name')->get(),
                    'status' => $req->status
                ]
            );
        }


        $data = ['User' => $user, 'No_of_requests' => $req_no, 'Requests' => $arr];
        return $this->SendResponse($data, "Requests sent");
    }


    public function showAccepted()
    {
        $arr = [];
        $user_id = Auth::user()->id;
        $user = User::select('id', 'name')->where('id', $user_id)->get();
        $Requests = Req::select()->where('post_owner_id', $user_id)->where('status', 'accept')->get();
        $req_no = $Requests->count();

        if ($req_no == 0)
            return $this->SendError('No Requests');

        foreach ($Requests as $req) {
            array_push(
                $arr,
                [
                    'reqeusted_post' => $req->post()->select('id', 'title')->get(),
                    'requester' => $req->requester()->select('id', 'name')->get(),
                    'status' => $req->status
                ]
            );
        }


        $data = ['User' => $user, 'No_of_requests' => $req_no, 'Requests' => $arr];
        return $this->SendResponse($data, "Requests sent");
    }

    public function showRejected()
    {
        $arr = [];
        $user_id = Auth::user()->id;
        $user = User::select('id', 'name')->where('id', $user_id)->get();
        $Requests = Req::select()->where('post_owner_id', $user_id)->where('status', 'reject')->get();
        $req_no = $Requests->count();

        if ($req_no == 0)
            return $this->SendError('No Requests');


        foreach ($Requests as $req) {
            array_push(
                $arr,
                [
                    'reqeusted_post' => $req->post()->select('id', 'title')->get(),
                    'requester' => $req->requester()->select('id', 'name')->get(),
                    'status' => $req->status
                ]
            );
        }


        $data = ['User' => $user, 'No_of_requests' => $req_no, 'Requests' => $arr];
        return $this->SendResponse($data, "Requests sent");
    }





    public function doReq(Request $request)
    {


        $old_req = DB::table('requests')->where('post_id', $request->post_id)->where('requester_id', Auth::user()->id)->get();
        $post = Post::find($request->post_id);
        if ($post == null) {
            return $this->SendError('Wrong Post');
        }
        $user = User::find($post->user_id);
        // dd($user->id);

        if ($post->user_id == Auth::id()) {
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

        $post = Post::find($post_id);

        if (Auth::id() != $post->user_id) {
            return $this->SendError("You Are Not Allowed To Show This Request");
        }
        $req = Req::where('post_id', $post_id)->where('requester_id', $req_id)->first();

        if (is_null($req)) {
            return $this->SendError("Wrong Request");
        }


        if (Auth::id() != $req->post_owner_id) {
            return $this->SendError("You Are Not Allowed to show this Req");
        }

        $post = $req->post()->select('id', 'title')->get();
        $requester = $req->requester()->select('id', 'name')->get();
        $req = Req::select('status', 'created_at')->where('post_id', $post_id)->where('requester_id', $req_id)->first();
        $data = ['Requester' => $requester, 'Post' => $post, 'Request' => $req];
        return $this->SendResponse($data, "Request sent");
    }

    public function approveRequest($post_id, $requester_id)
    {

        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError("Post Not Found");
        }

        if (Auth::id() != $post->user_id) {
            return $this->SendError("You Are Not Allowed To Edit This Request");
        }
        $q  = DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->first();

        if ($q == null) {
            return $this->SendError("Request Not Found");
        }

        // DB::table('course_student')->where('student_id',$id)->where('course_id', $c_id)->update(['status'=>'approve']);
        DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->update(['status' => 'accept']);


        //Check Number of Needed Person
        $post = Post::find($post_id);
        $needed_persons = $post->needed_persons;
        $accepted_reqs_no = DB::table('requests')->where('post_id', $post_id)->where('status', 'accept')->count();

        if ($needed_persons == $accepted_reqs_no) {
            $other_reqs = DB::table('requests')->where('post_id', $post_id)->where('status', '!=', 'accept');
            $other_reqs->update(['status' => 'reject']);
        }

        //Notification to requester
        $details = [
            'post_id' => $post->id,
            'title' =>'Request Accepted',
            'body' => 'Your request of "' . $post->title . '" post is accpeted',
        ];
        $user = User::find($requester_id);
        $user->notify(new RequestAccepted($details));

        return $this->SendResponse('Done', "Request Accepted");
    }

    public function rejectRequest($post_id, $requester_id)
    {
        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError("Post Not Found");
        }

        if (Auth::id() != $post->user_id) {
            return $this->SendError("You Are Not Allowed To Edit This Request");
        }
        $q  = DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->first();

        if ($q == null) {
            return $this->SendError("Request Not Found");
        }
        // DB::table('course_student')->where('student_id',$id)->where('course_id', $c_id)->update(['status'=>'approve']);
        DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->update(['status' => 'reject']);

        $details = [
            'post_id' => $post->id,
            'title' =>'Request Rejected',
            'body' => 'Your request of "' . $post->title . '" post is Rejected',
        ];
        $user = User::find($requester_id);
        $user->notify(new RequestRejected($details));
        return $this->SendResponse('Done', "Request Rejected");
    }

    public function deleteRequest($post_id, $requester_id)
    {
        $post = Post::find($post_id);

        if (Auth::id() != $post->user_id) {
            return $this->SendError("You Are Not Allowed To Edit This Request");
        }
        // DB::table('course_student')->where('student_id',$id)->where('course_id', $c_id)->update(['status'=>'approve']);
        DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->delete();
        return $this->SendResponse('Done', "Request Deleted");
    }


    public function cancelRequest($post_id, $requester_id)
    {
        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError("Post Not Found");
        }

        if (Auth::id() != $requester_id) {
            return $this->SendError("You Are Not Allowed To Cancel This Request");
        }
        $q  = DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id)->first();

        if ($q == null) {
            return $this->SendError("Request Not Found");
        }
        $req = DB::table('requests')->where('post_id', $post_id)->where('requester_id', $requester_id);

        //Notification To Post Owner
        $requester = User::find($requester_id);
        $post_owner = User::find($post->user_id);
        $details = [
            'post_id' => $post->id,
            'title' => 'Reqeuest Canceled ',
            'body' => $requester->name . '\'s Request of Your Post ' . $post->title . ' on ' . $post->group()->first()->name . ' group has been canceled ',
        ];

        $post_owner->notify(new RequestCanceled($details));

        $req->delete();

        //Add Cancel in DB

        // $old_cancel = DB::table('user_canceled_requests')->where('requester_id' , $requester_id)->first();
        // $old_cancel = CanceledRequest::where('requester_id', $requester_id)->first();
        // if ($old_cancel == null) {
            //Create New Row For this User
            $c = CanceledRequest::create(['requester_id' => $requester_id , 'post_id' => $post->id]);
        // } else {
            //Update Count Of Exited User
            // CanceledRequest::where('requester_id', $requester_id)->update(['req_count' =>  $old_cancel->req_count + 1    ]);
        // }

        return $this->SendResponse('Done', "Request Canceled");
    }


    public function mySentRequests()
    {
        $arr = [];
        $user_id = Auth::user()->id;
        $user = User::select('id', 'name')->where('id', $user_id)->get();
        $Requests = Req::select()->where('requester_id', $user_id)->where('status', 'pending')->get();
        $req_no = $Requests->count();

        if ($req_no == 0)
            return $this->SendError('No Requests');

        foreach ($Requests as $req) {
            array_push(
                $arr,
                [
                    'reqeusted_post' => $req->post()->select('id', 'title')->get(),
                    'requester' => $req->requester()->select('id', 'name')->get(),
                    'status' => $req->status
                ]
            );
        }


        $data = ['User' => $user, 'No_of_requests' => $req_no, 'Requests' => $arr];
        return $this->SendResponse($data, "User Sent Requests sent");

    }



}
