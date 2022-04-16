<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\FavGroupCollection;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
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

   public function GetGroupsByCategory($id)
   {
       $category = Category::find($id);
       $groups = $category->groups()->get();
       $js_groups = new GroupCollection($groups);
       return $this->SendResponse($js_groups , 'Groups Sent');
   }

   public function show($id)
   {
       $group = Group::find($id);
       if($group == null)
       {
           return $this->SendError('Group Not Found');
       }
       $js_group = new GroupResource($group);
       return $this->SendResponse($js_group , 'Group Sent');
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

       return $this->SendResponse('User Add Group','Added');
   }

   public function showFav()
   {
       $groups = FavGroups::where('user_id' , Auth::id())->get();
       $js_groups = new FavGroupCollection($groups);
       return $this->SendResponse($js_groups , 'Favorite Groups Sent');

   }
}
