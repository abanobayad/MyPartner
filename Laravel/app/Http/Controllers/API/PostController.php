<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends BaseController
{

    public function index()
    {
        $data = Post::all();
        foreach ($data as $d) {
            $d->image =  public_path('uploads/Posts/') . $d->image;
        }
        return $this->SendResponse($data, 'Data sent');
    }



    public function ADD(Request $request)
    {

        if (Auth::user()->id != $request->user_id) {
            return $this->SendError("You Are Not Allowed to ADD this post");
        }

        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'user_id' => 'required|exists:users,id',
                'group_id' => 'required|exists:groups,id',
                'title' => 'string|required',
                'content' => 'string|required',
                'location' => 'string|required',
                'image' => 'image|mimes:png,jpg,jpeg|nullable',
                'needed_persons' => 'numeric|required',
                'price' => 'numeric|required',
            ]
        );

        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        } else {
            if ($request->hasFile('image')) {
                $newImgName = $request->image->hashName();
                Image::make($input['image'])->save(public_path('uploads/Posts/' . $newImgName));
                $input['image'] = $newImgName;
            }

            $post = Post::create($input);
            $js_prof = new PostResource($post);
            return $this->SendResponse($js_prof, "Post Added");
        }
    }


    public function EDIT(Request $request, $post_id)
    {
        $input = $request->all();
        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError('Post not found');
        }

        if (Auth::user()->id != $request->user_id) {
            return $this->SendError("You Are Not Allowed to edit this post");
        } else {
            $validator = Validator::make(
                $input,
                [
                    'user_id' => 'required|exists:users,id',
                    'group_id' => 'required|exists:groups,id',
                    'title' => 'string|required',
                    'content' => 'string|required',
                    'location' => 'string|required',
                    'image' => 'image|mimes:png,jpg,jpeg|nullable',
                    'needed_persons' => 'numeric|required',
                    'price' => 'numeric|required',
                ]
            );

            if ($validator->fails()) {
                return $this->SendError("Error Of Edit profile", $validator->errors());
            } else {
                $OldImgName =  $post->image;
                if ($request->hasFile('image')) {
                    Storage::disk('uploads')->delete('Users/' . $OldImgName);
                    $newImgName = $request->image->hashName();
                    Image::make($input['image'])->save(public_path('uploads/Posts/' . $newImgName));
                    $input['image'] = $newImgName;
                } else    $input['image'] = $OldImgName;

                $post->update($input);
                $post->save();
                $post_Json = PostResource::make($post);
                return $this->SendResponse($post_Json, 'Post Updated');
            }
        }
    }

    public function GET($post_id)
    {
        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError('Post not found');
        } else {
            $js_prof = new PostResource($post);
            return $this->SendResponse($js_prof, 'Post sent Successfully');
        }
    }


    public function DELETE($post_id)
    {
        $post = Post::find($post_id); //get the post
        if($post == null){return $this->SendError('Post Not Found');}
        if (Auth::user()->id != $post->user_id) {
            return $this->SendError("You Are Not Allowed to Delete this Post");
        }
        $js_prof =  new PostResource($post);
        $post->delete();
        return $this->SendResponse($js_prof, 'Post Deleted Successfully');
    }
}
