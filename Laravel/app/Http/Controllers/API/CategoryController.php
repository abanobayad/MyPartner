<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\GroupCollection;
use App\Models\Category;
use App\Models\Group;
use App\Models\GroupVist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
   public function show()
   {

        $cats = Category::all();

        $user = User::find(Auth::id());
        $groups= $user->group_visits()->orderBy('updated_at' , 'desc')->get()->take(5);

        // $groups = GroupVist::with('groups')->where('user_id',Auth::id())->OrderBy('updated_at','desc')->get();
        // $groups = Group::get()->take(5);




        $js_cats = new CategoryCollection($cats);
        $js_recent_groups = new GroupCollection($groups);
        $data = ['categories' => $js_cats , 'groups'=>$js_recent_groups];

    if($cats == null & $groups == null )
    {
        return $this->SendError("Categoires and Recent Groups Not Found");
    }
    else
        return $this->SendResponse($data , "Categoires and Recent Groups Sent");
   }


   public function GetGroupsByCategory($id)
   {
       $category = Category::find($id);
       $groups = $category->groups()->get();
       $js_groups = new GroupCollection($groups);
       return $this->SendResponse($js_groups , 'Groups Sent');
   }

}
