<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostCollection;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\RateCollection;
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
        $posts = $user->posts()->get();
        $rate = Rate::select()->where('receiver_id', $user->id)->get();
        $sum = 0;
        if ($rate) {
            $total_rate = 'No Rates Yet';
        } else {
            foreach ($rate as $item) {
                $sum = $sum + $item->rate_value;
            }
            $total_rate = $sum / sizeof($rate);
        }



        //Response Handle
        if ($rate) {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);
            $data = ['user_info' => $js_Profile , 'Posts' => $js_Posts , 'total_rate' => $total_rate];
        }
        else
        {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);
            $js_rates = new RateCollection($rate);
            $data = ['user_info' => $js_Profile , 'Posts' => $js_Posts , 'total_rate' => $total_rate , 'rates' => $js_rates];
        }

        return $this->SendResponse($data , 'User Profile Sent');


    }


    public function guestAccount($user_id)
    {

        $user = User::find($user_id);
        $profile = $user->profile()->first();
        // dd($profile->user()->first()->name);
        $posts = $user->posts()->get();
        $rate = Rate::select()->where('receiver_id', $user->id)->get();
        $sum = 0;
        if ($rate) {
            $total_rate = 'No Rates Yet';
        } else {
            foreach ($rate as $item) {
                $sum = $sum + $item->rate_value;
            }
            $total_rate = $sum / sizeof($rate);
        }



        //Response Handle
        if ($rate) {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);

            $data = ['user_info' => $js_Profile , 'Posts' => $js_Posts , 'total_rate' => $total_rate];
        }
        else
        {
            $js_Profile = new ProfileResource($profile);
            $js_Posts = new PostCollection($posts);
            $js_rates = new RateCollection($rate);
            $data = ['user_info' => $js_Profile , 'Posts' => $js_Posts , 'total_rate' => $total_rate , 'rates' => $js_rates];
        }

        return $this->SendResponse($data , 'User Profile Sent');


    }




}
