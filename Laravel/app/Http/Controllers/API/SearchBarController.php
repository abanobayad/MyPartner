<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\GroupBarCollection;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class SearchBarController extends BaseController
{
    public function HomepageSearch(Request $request)
    {
        $search_keyword = $request->has('keyword') ? $request->get('keyword'):null;
        $search_category = $request->has('category') ? $request->get('category'):null;
        $search_tag = $request->has('tag') ? $request->get('tag'):[];

        $groups = Group::with(['category' , 'tags']);


        if ($search_keyword != null){
            $groups = $groups->search($search_keyword);
        }

        elseif($search_category != null)
        {
            $groups = $groups->whereCategoryId($search_category);
        }

        elseif(is_array($search_tag) && count($search_tag) >0)
        {
            $groups = $groups->whereHas('tags', function ($query) use ($search_tag) {
                $query->whereIn('groups_tags.tag_id', $search_tag);
            });
        }

        $data= $groups->latest()->get();

        if(count($data) == 0){
            return $this->SendError("No Matchs");
        }
        $js = new GroupBarCollection($data);
        return $this->SendResponse($js, "Search Result Sent");

    }


    public function ProfilePostSearch(Request $request , $user_id)
    {
        //  $request->validate(['keyword' => 'required|string']);

        $validate = Validator::make($request->all() ,
        ['keyword' => 'required|string']);

        if($validate->fails())
        return $this->SendError($validate->errors());

            $key = $request->keyword;
            $filteredPosts = Post::
                  where([['user_id' , $user_id],['title' , 'like' , '%'. $key .'%'],])
                ->orWhere([['user_id' , $user_id],['content' , 'like' , '%'. $key .'%']])
                    ->get();


        //  dd($filteredPosts->count());
        if($filteredPosts->count() != 0)
        {
            return $this->SendResponse( new PostCollection($filteredPosts) , "Search Result Sent");        }
        else
        {
            return $this->SendError("No Matchs");
        }
    }



    public function GroupPostSearch(Request $request , $user_id)
    {
        //  $request->validate(['keyword' => 'required|string']);

        $validate = Validator::make($request->all() ,
        ['keyword' => 'required|string']);

        if($validate->fails())
        return $this->SendError($validate->errors());

            $key = $request->keyword;
            $filteredPosts = Post::
                  where([['group_id' , $user_id],['title' , 'like' , '%'. $key .'%'],])
                ->orWhere([['group_id' , $user_id],['content' , 'like' , '%'. $key .'%']])
                    ->get();


        //  dd($filteredPosts->count());
        if($filteredPosts->count() != 0)
        {
            return $this->SendResponse( new PostCollection($filteredPosts) , "Search Result Sent");        }
        else
        {
            return $this->SendError("No Matchs");
        }
    }
}
