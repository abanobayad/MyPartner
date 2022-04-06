<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Notifications\MakeComment;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CommentController extends BaseController
{
    public function comment(Request $request)
    {

        $post = Post::find($request->post_id);
        $user = User::find($post->user_id);          //Post Owner

        $validator = Validator::make(
            $request->all(),
            [
                'comment_content' => 'required',
                'image' => 'nullable|mimes:png,jpg,jpeg|image'
            ]
        );

        if ($validator->fails()) {
            return $this->SendError('Error Of Validation', $validator->errors());
        }
        if ($request->hasFile('image')) {
            $newImgName = $request->image->hashName();
            Image::make($request->image)->save(public_path('uploads/Comments/' . $newImgName));
            $request->image = $newImgName;

            Comment::create(
                [
                    'user_id'    => Auth::id(),
                    'post_id'    => $request->post_id,
                    'content'    => $request->comment_content,
                    'image'      => 'nullable|mimes:png,jpg,jpeg|image',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        } else {
            Comment::create(
                [
                    'user_id'    => Auth::id(),
                    'post_id'    => $request->post_id,
                    'content'    => $request->comment_content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        if (Auth::id() != $user->id) {
            $group = $post->group()->first();
            $details = [
                'post_id' => $post->id,
                'title' => 'New Comment On ' . $post->title,
                'body' => 'Your post in ' . $group->name . ' group has new comment from ' . Auth::user()->name,
            ];

            $user->notify(new MakeComment($details));
        }
        return $this->SendResponse($request->comment_content, "Comment Added Successfuly");
    }

    public function edit(Request $request, $c_id)
    {
        $request->updated_at = now();
        $comment = Comment::find($c_id);
        // dd($comment->image);
        $input = $request->all();
        // dd($input['image']);
        $validator = Validator::make($request->all(), ['comment_content' => 'required', 'image' => 'nullable|mimes:png,jpg,jpeg|image']);

        if ($validator->fails()) {
            return $this->SendError('Error Of Validation', $validator->errors());
        }



        //Chcek IMAGES
        $OldImgName =  $comment->image;
        if ($request->hasFile('image')) {
            Storage::disk('uploads')->delete('Comments/' . $OldImgName);
            $newImgName = $request->image->hashName();
            Image::make($input['image'])->save(public_path('uploads/Comments/' . $newImgName));
            $input['image'] = $newImgName;
        } else    $input['image'] = $OldImgName;


        $comment->update($input);
        $comment->save();

        $comment_Json = CommentResource::make($comment);
        return $this->SendResponse($comment_Json, "Comment Edit Success");
    }


    public function DELETE($id)
    {
        $comment = Comment::find($id);
        if ( $comment == null) {
            return $this->SendError("comment not found");
        }else{
            if ($comment->user_id != Auth::id()) {
                return $this->SendError("You Are Not Allowed to delete this comment");
            }else{
                $comment = $comment->delete();
                return $this->SendResponse($comment, 'comment Deleted Successfully');
            }
        }
    }
}
