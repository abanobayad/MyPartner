<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use App\Models\Reply;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\MakeComment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Notifications\MakeReply;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ReplyController extends BaseController
{
    public function make(Request $request)
    {

        $comment = Comment::find($request->comment_id);
        if ($comment == null) {
            return $this->SendError('Comment Not Found');
        }
        $user = User::find($comment->user->id);          //comment Owner
        $post = Post::find($comment->post_id);


        $validator = Validator::make(
            $request->all(),
            [
                'content' => 'required',
                'image' => 'nullable|mimes:png,jpg,jpeg|image'
            ]
        );

        if ($validator->fails()) {
            return $this->SendError('Error Of Validation', $validator->errors());
        }
        if ($request->hasFile('image')) {

            // Check Image Legal
            $client = new RekognitionClient(
                [
                    'region' => env('AWS_DEFAULT_REGION'),
                    'version' => 'latest',
                ]
            );

            $image = fopen($request->file('image')->getPathname(), 'r');
            $bytes = fread($image, $request->file('image')->getSize());

            $result = $client->detectModerationLabels(
                [
                    'Image' => ['Bytes' => $bytes],
                    'MinConfidence' => 50,
                ]
            );

            $resLables = $result->get('ModerationLabels');
            // dd($resLables);


            if (array_search('Explicit Nudity', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Nudity content');
            } else if (array_search('Drugs', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Drugs content');
            } else if (array_search('Weapon Violence', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Weapon Violence content');
            } else if (array_search('Weapon Violence', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Weapon Violence content');
            } else if (array_search('Violence', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Violence content');
            } else if (array_search('Hate Symbols', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Hate Symbols');
            } else if (array_search('Alcohol', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Alcoholic Beverages"');
            } else if (array_search('Rude Gestures', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Rude Gestures');
            } else if (array_search('Tobacco', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Tobacco Products');
            }

            $newImgName = $request->image->hashName();
            Image::make($request->image)->save(public_path('uploads/replies/' . $newImgName));
            $request->image = $newImgName;

            Reply::create(
                [
                    'user_id'    => Auth::id(),
                    'comment_id' => $request->comment_id,
                    'content'    => $request->content,
                    'image'      => 'nullable|mimes:png,jpg,jpeg|image',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        } else {
            Reply::create(
                [
                    'user_id'    => Auth::id(),
                    'comment_id' => $request->comment_id,
                    'content'    => $request->content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // notify post owner
        if (Auth::id() != $post->user_id) {
            $post_owner = User::find($post->user_id);
            $details = [
                'post_id' => $post->id,
                'comment_id' => $comment->id,
                'title' => 'New Reply On ' . $comment->content,
                'body' => 'Your Comment on ' . $post->title . ' post has new reply from ' . Auth::user()->name,
            ];

            $post_owner->notify(new MakeReply($details));
        }

        // notify comment owner
        if (Auth::id() != $comment->user_id) {
            $details = [
                'post_id' => $post->id,
                'comment_id' => $comment->id,
                'title' => 'New Reply On ' . $comment->content,
                'body' => 'Your Comment on ' . $post->title . ' post has new reply from ' . Auth::user()->name,
            ];

            $user->notify(new MakeReply($details));
        }

        return $this->SendResponse($request->content, "Reply Added Successfuly");
    }


    public function edit(Request $request, $replay_id)
    {
        $request->updated_at = now();
        $reply = Reply::find($replay_id);
        $input = $request->all();
        $validator = Validator::make($request->all(), ['content' => 'required', 'image' => 'nullable|mimes:png,jpg,jpeg|image']);

        if ($validator->fails()) {
            return $this->SendError('Error Of Validation', $validator->errors());
        }



        //Chcek IMAGES
        $OldImgName =  $reply->image;
        if ($request->hasFile('image')) {
            // Check Image Legal
            $client = new RekognitionClient(
                [
                    'region' => env('AWS_DEFAULT_REGION'),
                    'version' => 'latest',
                ]
            );

            $image = fopen($request->file('image')->getPathname(), 'r');
            $bytes = fread($image, $request->file('image')->getSize());

            $result = $client->detectModerationLabels(
                [
                    'Image' => ['Bytes' => $bytes],
                    'MinConfidence' => 50,
                ]
            );

            $resLables = $result->get('ModerationLabels');
            // dd($resLables);


            if (array_search('Explicit Nudity', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Nudity content');
            } else if (array_search('Drugs', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Drugs content');
            } else if (array_search('Weapon Violence', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Weapon Violence content');
            } else if (array_search('Weapon Violence', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Weapon Violence content');
            } else if (array_search('Violence', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Violence content');
            } else if (array_search('Hate Symbols', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Hate Symbols');
            } else if (array_search('Alcohol', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Alcoholic Beverages"');
            } else if (array_search('Rude Gestures', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Rude Gestures');
            } else if (array_search('Tobacco', array_column($resLables, 'Name')) !== false) {
                return $this->SendError('The Image has Tobacco Products');
            }
            Storage::disk('uploads')->delete('Comments/' . $OldImgName);
            $newImgName = $request->image->hashName();
            Image::make($input['image'])->save(public_path('uploads/Comments/' . $newImgName));
            $input['image'] = $newImgName;
        } else    $input['image'] = $OldImgName;


        $reply->update($input);
        $reply->save();

        //$reply_Json = CommentResource::make($comment);
        return $this->SendResponse($reply, "Comment Edit Success");
    }



    public function DELETE($id)
    {
        $reply = Reply::find($id);
        if ($reply == null) {
            return $this->SendError("reply not found");
        } else {
            if ($reply->user_id != Auth::id()) {
                return $this->SendError("You Are Not Allowed to delete this rate");
            } else {
                $reply = $reply->delete();
                return $this->SendResponse($reply, 'reply Deleted Successfully');
            }
        }
    }
}
