<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ProfileController extends BaseController
{
    public function index()
    {
        $data = Profile::all();
        foreach ($data as $d) {
            $d->image =  public_path('uploads/Users/').$d->image;
        }
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
                'gender' => 'in:male,female|nullable',
            ]
        );
        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        } else {


            if ($request->hasFile('image')) {
                $newImgName = $input['image']->hashName();
                Image::make($input['image'])->save(public_path('uploads/Users/' . $newImgName));
                $input['image'] = $newImgName;
            }

            $profile = Profile::create($input);
            $js_prof = new ProfileResource($profile);
            return $this->SendResponse($js_prof, "Profile Added");
        }
    }

    public function EDIT(Request $request )
    {
        $input = $request->all();
        $user = User::find(Auth::id());
        // dd($user);
        if ($user == null) {
            return $this->SendError('User not found');
        }
        $profile = $user->profile()->first();


            $validator = Validator::make(
                $input,
                [
                    'name' => 'string|required|max:20',
                    'image' => 'image|mimes:png,jpg,jpeg|nullable',
                    'phone' => 'string|min:8|max:11|nullable',
                    'address' => 'string|nullable',
                    'bio' => 'string|nullable',
                    'gender' => 'in:male,female|nullable',
                ]
            );

            if ($validator->fails()) {
                return $this->SendError("Error Of Edit profile", $validator->errors());
            } else {
                $OldImgName =  $profile->image;
                if ($request->hasFile('image')) {
                    Storage::disk('uploads')->delete('Users/' . $OldImgName);
                    $newImgName = $request->image->hashName();
                    Image::make($input['image'])->save(public_path('uploads/Users/' . $newImgName));
                    $input['image'] = $newImgName;
                }
                else    $input['image'] = $OldImgName;

                $user->update(['name' => $input['name']]);
                $user->save();
                $profile->update(
                    [
                        'image' => $input['image'],
                        'phone' => $input['phone'],
                        'address' => $input['address'],
                        'bio' => $input['bio'],
                        'gender' => $input['gender'],
                    ]
                );
                $profile->save();
                $profile_Json = ProfileResource::make($profile);
                return $this->SendResponse($profile_Json, 'Profile Updated');
            }

    }

    public function GET($id)
    {
        $user = User::find($id);
        // dd($user);
        if ($user == null) {
            return $this->SendError('User not found');
        }
        $profile = $user->profile()->first();
        if (is_null($profile))
            return $this->SendError('Profile not found');
        else {
            $js_prof = new ProfileResource($profile);
            return $this->SendResponse($js_prof, 'Profile sent Successfully');
        }
    }

    public function DELETE($id)
    {
        if (Auth::user()->id != $id) {
            return $this->SendError("You Are Not Allowed to delete this profile");
        }

        $user = User::find($id);
        // dd($user);
        if ($user == null) {
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
                $js_prof =  new ProfileResource($profile);
                $profile->delete();
                return $this->SendResponse($js_prof, 'Profile Deleted Successfully');
            }
        }
    }


    public function UserAcc($id)
    {
        //Need To show User Profile data + His Posts  {{without its comments and replies}}
// dd('sw');
        $user = User::find($id);
        $profile  = $user->profile()->get();
        $posts  = $user->posts()->get();
        // dd($posts);
        $data['profile'] =$profile;
        $data['posts'] = $posts;

        $js_data = new ProfileResource($data);
        return $this->SendResponse($data , "Data Of Account Sent successfuly" );

    }
}
