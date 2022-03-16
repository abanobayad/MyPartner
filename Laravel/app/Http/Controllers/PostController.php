<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Models\User;


class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return $this->SendResponse($data, 'Data sent');
    }

public function ADD(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'user_id' => 'required|exists:users,id|unique:profiles,user_id',
                'image' => 'image|mimes:png,jpg,jpeg|nullable',
                'phone' => 'string|min:8|max:11|nullable',
                'address' => 'string|nullable',
                'bio' => 'string|nullable',
                'gender' => 'nullable',
            ]
        );
        if ($validator->fails()) {
            $validator->errors()->user_id = 'User Has Profile Already';
            return $this->SendError("Validate Input",  $validator->errors()->user_id );
        } else {
            $profile = Post::create($input);
            $js_prof = new PostResource($profile);
            return $this->SendResponse($js_prof, "Profile Added");
        }
    }

public function EDIT(Request $request)
    {
        $input = $request->all();
        $user = User::find($request->user_id);
        // dd($user);
        if($user == null)
        {
            return $this->SendError('User not found');
        }
        $profile = $user->profile()->first();
        //  dd($profile->user_id);
        //  dd(Auth::user()->id == $profile->user_id);
        if (Auth::user()->id != $request->user_id) {
            return $this->SendError("You Are Not Allowed to edit this profile");
        } else {
            $validator = Validator::make(
                $input,
                [
                    'user_id' => 'required|exists:users,id',
                    'image' => 'image|mimes:png,jpg,jpeg|nullable',
                    'phone' => 'string|min:8|max:11|nullable',
                    'address' => 'string|nullable',
                    'bio' => 'string|nullable',
                    'gender' => 'nullable',
                ]
            );

            if ($validator->fails()) {
                return $this->SendError("Error Of Edit profile", $validator->errors());
            } else {
                $profile->update($input);
                $profile->save();
                $profile_Json = PostResource::make($profile);
                return $this->SendResponse($profile_Json, 'Profile Updated');
            }
        }
    }

public function GET($id)
    {
        $user = User::find($id);
        // dd($user);
        if($user == null)
        {
            return $this->SendError('User not found');
        }
        $profile = $user->profile()->first();
        if (is_null($profile))
            return $this->SendError('Profile not found');
        else {
            $js_prof = new PostResource($profile);
            return $this->SendResponse($js_prof, 'Profile sent Successfully');
        }
    }

public function DELETE($id)
    {
        $user = User::find($id);
        // dd($user);
        if($user == null)
        {
            return $this->SendError('User not found');
        }
        $profile = $user->profile()->first();
        // dd($profile);
        if (is_null($profile)) {
            return $this->SendError('Profile not found');
        } else {
            if (Auth::user()->id != $profile->user_id) {
                return $this->SendError("You Are Not Allowed to delete this Profile");
            } else {
                $js_prof =  new PostResource($profile);
                $profile->delete();
                return $this->SendResponse($js_prof, 'Profile Deleted Successfully');
            }
        }
    }
}
