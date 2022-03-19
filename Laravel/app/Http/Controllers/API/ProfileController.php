<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage;


class ProfileController extends BaseController
{
    public function index()
    {
        $data = Profile::all();
        // $js = new ProfileResource($data);
        foreach ($data as $d) {
            $d->created_at = $d->created_at->format('d/m/Y');
            $d->updated_at = $d->updated_at->format('d/m/Y');
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
                'gender' => 'nullable',
            ]
        );
        if ($validator->fails()) {
            $validator->errors()->user_id = 'User Has Profile Already';
            return $this->SendError("Validate Input",  $validator->errors()->user_id);
        } else {


            if ($request->hasFile('image')) {
                $newImgName = $request->image->hashName();
                Image::make($request->image)->save(public_path('uploads/Users/' . $newImgName));
                $request->image = $newImgName;
            }

            $profile = Profile::create($input);
            $js_prof = new ProfileResource($profile);
            return $this->SendResponse($js_prof, "Profile Added");
        }
    }

    public function EDIT(Request $request)
    {
        $input = $request->all();
        $user = User::find($request->user_id);
        // dd($user);
        if ($user == null) {
            return $this->SendError('User not found');
        }
        $profile = $user->profile()->first();

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
                $OldImgName =  $profile->image;
                if ($request->hasFile('image')) {
                    Storage::disk('uploads')->delete('Users/' . $OldImgName);
                    $newImgName = $request->image->hashName();
                    Image::make($request->image)->save(public_path('uploads/Users/' . $newImgName));
                    $input['image'] = $newImgName;
                }
                else    $input['image'] = $OldImgName;

                $profile->update($input);
                $profile->save();
                $profile_Json = ProfileResource::make($profile);
                return $this->SendResponse($profile_Json, 'Profile Updated');
            }
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
}
