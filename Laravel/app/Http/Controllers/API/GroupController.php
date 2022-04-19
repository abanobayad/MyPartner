<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\FavGroupCollection;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use App\Models\FavGroups;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GroupController extends BaseController
{
   public function index()
   {
       $groups = Group::all();
       return $this->SendResponse($groups , 'Groups Sent');
   }



   public function show($id)
   {
       $group = Group::find($id);
       $posts = $group->posts()->get();
       if($group == null)
       {
           return $this->SendError('Group Not Found');
       }
       $js_group = new GroupResource($group);
       $js_posts = new PostCollection($posts);
       $data =[
           'group' =>$js_group,
           'posts' =>$js_posts,
       ];
       return $this->SendResponse($data , 'Group with it\'s posts  Sent');
   }




   public function FavGroup($group_id)
   {
    $old_group = DB::table('fav_groups')->where('group_id', $group_id)->where('user_id', Auth::user()->id)->get();
    if(count($old_group) > 0)
    {
        return $this->SendError('This Group Added Before');
    }

       FavGroups::create(
           [
               'user_id' => Auth::id() ,
               'group_id' => $group_id
           ]
       );

       return $this->SendResponse('User Add Group To Fav','Added');
   }


   public function UnFavGroup($group_id)
   {
    $f = FavGroups::select()->where('group_id' , $group_id)->where('user_id' , Auth::id())->first();
    if(count($f) == 0)
    {
        return $this->SendError('This Group Doesn\'t Favorite Before');
    }
    else
    {
        $f->delete();
       return $this->SendResponse('User Remove Group From Fav','Removed');
    }
   }

   public function showFav()
   {
       $groups = FavGroups::where('user_id' , Auth::id())->get();
       $js_groups = new FavGroupCollection($groups);
       return $this->SendResponse($js_groups , 'Favorite Groups Sent');

   }


}
