<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\FavGroupCollection;
use App\Http\Resources\GroupResource;
use App\Http\Resources\PostCollection;
use App\Models\FavGroups;
use App\Models\Group;
use App\Models\GroupVist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends BaseController
{
    public function index()
    {
        $groups = Group::all();
        return $this->SendResponse($groups, 'Groups Sent');
    }



    public function show($id)
    {

        $group = Group::find($id);

        if($group==null)
        {
            return $this->SendError("Group Not Found");
        }

        $q = GroupVist::where('user_id' , Auth::id())->where('group_id' , $id)->first();
        // dd($q);
        if($q == null)
        {
            GroupVist::create(
                [
                'user_id' => Auth::id(),
                'group_id' => $id,
            ]);
        }
        else
        {
            $q->updated_at = now();
            $q->times = $q->times+1;
            $q->save();
        }


        $posts = $group->posts()->where('visible','yes')->get();
        $js_group = new GroupResource($group);
        $js_posts = new PostCollection($posts);
        $data = [
            'group' => $js_group,
            'posts' => $js_posts,
        ];
        return $this->SendResponse($data, 'Group with it\'s posts  Sent');
    }


    public function FavGroup($group_id)
    {
        $group = Group::find($group_id);
        if ($group == null) {
            return $this->SendError('Group Not Found');
        }
        $old_group = DB::table('fav_groups')->where('group_id', $group_id)->where('user_id', Auth::user()->id)->get();
        if (count($old_group) > 0) {
            return $this->SendError('This Group Added Before');
        }

        FavGroups::create(
            [
                'user_id' => Auth::id(),
                'group_id' => $group_id
            ]
        );

        return $this->SendResponse('User Add Group To Fav', 'Added');
    }


    public function UnFavGroup($group_id)
    {
        $group = Group::find($group_id);
        if ($group == null) {
            return $this->SendError('Group Not Found');
        }
        $f = FavGroups::select()->where('group_id', $group_id)->where('user_id', Auth::id())->first();
        // dd($f);
        if ($f == null) {
            return $this->SendError('This Group Doesn\'t Favorite Before');
        } else {
            DB::table('fav_groups')->where('group_id', $group_id)->where('user_id', Auth::id())->delete();
            return $this->SendResponse('User Remove Group From Fav', 'Removed');
        }
    }

    public function showFav()
    {
        $groups = FavGroups::where('user_id', Auth::id())->get();
        $js_groups = new FavGroupCollection($groups);
        return $this->SendResponse($js_groups, 'Favorite Groups Sent');
    }
}
