<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostCollection;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\RateCollection;
use App\Models\CanceledRequest;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends BaseController
{
    public function myAccount()
    {

        $user = User::find(Auth::id());
        $profile = $user->profile()->first();
        // dd($profile->user()->first()->name);
        $posts = $user->posts()->where('visible', 'yes')->get();
        $rate = Rate::select()->where('receiver_id', $user->id)->get();
        $sum = 0;
        if ($rate->count() == 0) {
            $total_rate = 'No Rates Yet';
        } else {
            foreach ($rate as $item) {
                $sum = $sum + $item->rate_value;
            }
            $total_rate = $sum / sizeof($rate);
        }


        $cancled = CanceledRequest::where('requester_id', Auth::id())->get()->count();

        //Response Handle
        if ($rate) {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);

            if ($cancled == 0) {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'canceled_Requests' => 0];
            } else {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'canceled_Requests' => $cancled];
            }
        } else {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);
            $js_rates = new RateCollection($rate);
            if ($cancled == 0) {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'rates' => $js_rates, 'canceled_Requests' => 0];
            } else {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'rates' => $js_rates, 'canceled_Requests' => $cancled];
            }
        }

        return $this->SendResponse($data, 'User Profile Sent');
    }


    public function guestAccount($user_id)
    {

        $user = User::find($user_id);
        if ($user == null) {
            return $this->SendError('User Not Found Please Enter Right ID');
        }
        $profile = $user->profile()->first();
        // dd($profile->user()->first()->name);
        $posts = $user->posts()->where('visible', 'yes')->get();
        $rate = Rate::select()->where('receiver_id', $user->id)->get();
        $sum = 0;
        if ($rate->count() == 0) {
            $total_rate = 'No Rates Yet';
        } else {
            foreach ($rate as $item) {
                $sum = $sum + $item->rate_value;
            }
            $total_rate = $sum / sizeof($rate);
        }



        // $cancled= $user->cancelRequests()->first()->reqs_count;
        $cancled = CanceledRequest::where('requester_id', $user_id)->get()->count();


        //Response Handle
        if ($rate) {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);

            if ($cancled == null) {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'canceled_Requests' => 0];
            } else {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'canceled_Requests' => $cancled->req_count];
            }
        } else {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);
            $js_rates = new RateCollection($rate);
            if ($cancled == null) {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'rates' => $js_rates, 'canceled_Requests' => 0];
            } else {
                $data = ['user_info' => $js_Profile, 'Posts' => $js_Posts, 'total_rate' => $total_rate, 'rates' => $js_rates, 'canceled_Requests' => $cancled->req_count];
            }
        }

        return $this->SendResponse($data, 'User Profile Sent');
    }
}
