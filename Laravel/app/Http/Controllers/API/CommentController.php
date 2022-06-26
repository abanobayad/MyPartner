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
use App\Models\IllegalWords;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController
{
    public function comment(Request $request)
    {

        $words = IllegalWords::all();

        $arr_words = [];

        foreach ($words as $word) {
            array_push($arr_words, $word->word);
        }
        // array_values($arr_words);
        // dd('stop');
        Config::set('profanity.defaults', array_values($arr_words));

        $post = Post::find($request->post_id);
        $user = User::find($post->user_id);          //Post Owner

        $validator = Validator::make(
            $request->all(),
            [
                'comment_content' => 'required|profanity',
                'image' => 'nullable|mimes:png,jpg,jpeg|image'
            ],
            ['profanity' => 'the :attribute has illegal words']
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

            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move('uploads/Comments/', $file_name);
            $input['image'] = $file_name;
            $comment =   Comment::create(
                [
                    'user_id'    => Auth::id(),
                    'post_id'    => $request->post_id,
                    'content'    => $request->comment_content,
                    'image'      => $input['image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        } else {
            $comment =   Comment::create(
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
        $js_comment = new CommentResource($comment);
        return $this->SendResponse($js_comment, "Comment Added Successfuly");
    }

    public function edit(Request $request, $c_id)
    {
        $words = IllegalWords::all();

        $arr_words = [];

        foreach ($words as $word) {
            array_push($arr_words, $word->word);
        }
        // array_values($arr_words);
        // dd('stop');
        Config::set('profanity.defaults', array_values($arr_words));

        $request->updated_at = now();
        $comment = Comment::find($c_id);
        if ($comment == null) {
            return $this->SendError('Comment Not Found');
        }
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),

            [
                'comment_content' => 'required|profanity',
                'image' => 'nullable|mimes:png,jpg,jpeg|image'
            ],
            ['profanity' => 'the :attribute has illegal words']

        );

        if ($validator->fails()) {
            return $this->SendError('Error Of Validation', $validator->errors());
        }



        //Chcek IMAGES
        $OldImgName =  $comment->image;
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

            $dest = 'uploads/Comments/' . $comment->image;
            if (File::exists($dest)) {
                File::delete($dest);
            }
            Storage::disk('uploads')->delete('Comments/' . $OldImgName);
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move('uploads/Comments/', $file_name);
            $input['image'] = $file_name;
        } else    $input['image'] = $OldImgName;


        $comment->update($input);
        $comment->save();

        $comment_Json = CommentResource::make($comment);
        return $this->SendResponse($comment_Json, "Comment Edit Success");
    }

    public function get($c_id)
    {
        $comment = Comment::find($c_id);
        if ($comment == null) {
            return $this->SendError('Comment Not Found');
        }

        $comment_Json = CommentResource::make($comment);
        return $this->SendResponse($comment_Json, "Comment Sent Successfully");
    }

    public function post_comment($post_id)
    {
        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError('Post Not Found');
        }
        $comments = Comment::all()->where('post_id' , $post_id);
        if($comments->first() == null){
            return $this->SendError('Post has no comment');
        }else{
            $comment_Json = CommentResource::collection($comments);
            return $this->SendResponse($comment_Json, "Comments Sent Successfully");
        }
    }

    public function DELETE($id)
    {
        $comment = Comment::find($id);
        if ($comment == null) {
            return $this->SendError("comment not found");
        } else {
            if ($comment->user_id != Auth::id()) {
                return $this->SendError("You Are Not Allowed to delete this comment");
            } else {
                $dest = 'uploads/Comments/' . $comment->image;
                if (File::exists($dest)) {
                    File::delete($dest);
                }
                $comment = $comment->delete();
                return $this->SendResponse($comment, 'Comment Deleted Successfully');
            }
        }
    }
}
