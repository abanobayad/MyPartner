<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\SavedPostsCollection;
use App\Models\Admin;
use App\Models\Group;
use App\Models\SavedPosts;
use App\Notifications\PostAdded;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Models\IllegalWords;
use Illuminate\Support\Facades\Config;

class PostController extends BaseController
{


    public function index()
    {
        $data = Post::all();
        foreach ($data as $d) {
            $d->image =  'uploads/Posts/' . $d->image;
        }
        return $this->SendResponse($data, 'Data sent');
    }

    public function ADD(Request $request)
    {
        $words = IllegalWords::all();

        $arr_words = [];

        foreach ($words as $word) {
            array_push($arr_words, $word->word);
        }
        // array_values($arr_words);
        // dd('stop');
        Config::set('profanity.defaults', array_values($arr_words));

        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'group_id' => 'required|exists:groups,id',
                'title' => 'string|required',
                'content' => 'string|required|profanity',
                'location' => 'string|required|url',
                'image' => 'image|mimes:png,jpg,jpeg|nullable',
                'needed_persons' => 'numeric|required',
                'price' => 'numeric|required',
            ]
        );
        $input['user_id'] = Auth::user()->id;
        $input['visible'] = 'no';

        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        } else {

            if ($request->hasFile('image')) {

                // Check Image Legal
                $client = new RekognitionClient(
                    [
                        'region' => env('AWS_DEFAULT_REGION') ,
                        'version' =>'latest' ,
                    ]
                );

                $image = fopen($request->file('image')->getPathname(),'r');
                $bytes = fread($image , $request->file('image')->getSize());

                $result = $client->detectModerationLabels(
                    [
                        'Image' => ['Bytes' => $bytes],
                        'MinConfidence' => 70,
                    ]
                );

                $resLables = $result->get('ModerationLabels');
                // dd($resLables);

                if(array_search('Explicit Nudity' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Nudity content');
                }
                else if(array_search('Drugs' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Drugs content');
                }
                else if(array_search('Weapon Violence' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Weapon Violence content');
                }
                else if(array_search('Weapon Violence' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Weapon Violence content');
                }
                else if(array_search('Violence' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Violence content');
                }
                else if(array_search('Hate Symbols' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Hate Symbols');
                }
                else if(array_search('Alcohol' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Alcoholic Beverages"');
                }

                else if(array_search('Rude Gestures' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Rude Gestures');
                }

                else if(array_search('Tobacco' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Tobacco Products');
                }

                $file = $request->file('image');
                $file_name = time().$file->getClientOriginalName();
                $file->move('uploads/Posts/',$file_name);
                $input['image'] = $file_name;
            }

            $post = Post::create($input);
            $js_prof = new PostResource($post);

            $group = Group::find($request->group_id);
            return $this->SendResponse($js_prof, "Post Added in $group->name Group");
        }
    }


    public function EDIT(Request $request, $post_id)
    {
        $words = IllegalWords::all();

        $arr_words = [];

        foreach ($words as $word) {
            array_push($arr_words, $word->word);
        }
        // array_values($arr_words);
        // dd('stop');
        Config::set('profanity.defaults', array_values($arr_words));

        $input = $request->all();
        $post = Post::find($post_id);
        if ($post == null) {
            return $this->SendError('Post not found');
        }

        else {
            $validator = Validator::make(
                $input,
                [
                    'group_id' => 'required|exists:groups,id',
                    'title' => 'string|profanity|required',
                    'content' => 'string|profanity|required',
                    'location' => 'string|required',
                    'image' => 'image|mimes:png,jpg,jpeg|nullable',
                    'needed_persons' => 'numeric|required',
                    'price' => 'numeric|required',
                ],
                ['profanity' => 'the :attribute has illegal words']
            );

            $input['user_id'] = Auth::user()->id;

            if ($validator->fails()) {
                return $this->SendError("Error Of Edit profile", $validator->errors());
            } else {
                $OldImgName =  $post->image;
                if ($request->hasFile('image')) {
                      // Check Image Legal
                $client = new RekognitionClient(
                    [
                        'region' => env('AWS_DEFAULT_REGION') ,
                        'version' =>'latest' ,
                    ]
                );

                $image = fopen($request->file('image')->getPathname(),'r');
                $bytes = fread($image , $request->file('image')->getSize());

                $result = $client->detectModerationLabels(
                    [
                        'Image' => ['Bytes' => $bytes],
                        'MinConfidence' => 50,
                    ]
                );

                $resLables = $result->get('ModerationLabels');
                // dd($resLables);


                if(array_search('Explicit Nudity' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Nudity content');
                }
                else if(array_search('Drugs' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Drugs content');
                }
                else if(array_search('Weapon Violence' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Weapon Violence content');
                }
                else if(array_search('Weapon Violence' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Weapon Violence content');
                }
                else if(array_search('Violence' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Violence content');
                }
                else if(array_search('Hate Symbols' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Hate Symbols');
                }
                else if(array_search('Alcohol' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Alcoholic Beverages"');
                }

                else if(array_search('Rude Gestures' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Rude Gestures');
                }

                else if(array_search('Tobacco' , array_column($resLables , 'Name')) !== false)
                {
                    return $this->SendError('The Image has Tobacco Products');
                }

                $dest = 'uploads/Posts/' . $post->image;
                if (File::exists($dest)) {
                    File::delete($dest);
                }
                    Storage::disk('uploads')->delete('Posts/' . $OldImgName);
                    // $newImgName = $request->image->hashName();
                    // Image::make($input['image'])->save(public_path('uploads/Posts/' . $newImgName));
                    $file = $request->file('image');
                    $file_name = time().$file->getClientOriginalName();
                    $file->move('uploads/Posts/',$file_name);
                    $input['image'] = $file_name;
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



    public function SavePost($post_id)
    {
        $post = Post::find($post_id);
        if($post == null) {return $this->SendError('Post Not Found');}
        $old_post = DB::table('saved_posts')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->get();
        if(count($old_post) > 0)
        {
        return $this->SendError('This Post Saved Before');
        }

        SavedPosts::create(
            [
                'user_id' => Auth::id() ,
                'post_id' => $post_id
            ]
        );

        return $this->SendResponse('User Save Post','Added');
    }


    public function UnSavePost($post_id)
    {
        $post = Post::find($post_id);
        if($post == null) {return $this->SendError('Post Not Found');}
        $f = SavedPosts::select()->where('post_id' , $post_id)->where('user_id' , Auth::id())->first();
        // dd($f);
        if($f == null)
        {
            return $this->SendError('This Post Doesn\'t Saved Before');
        }
        else
        {
            DB::table('saved_posts')->where('post_id', $post_id)->where('user_id', Auth::id())->delete();
        return $this->SendResponse('User Unsave Post','Removed');
        }
    }

    public function showSaved()
    {
        $posts = SavedPosts::where('user_id' , Auth::id())->get();
        // dd($posts);
        $js_posts = new SavedPostsCollection($posts);
        return $this->SendResponse($js_posts , 'Saved Posts Sent');

    }

}
