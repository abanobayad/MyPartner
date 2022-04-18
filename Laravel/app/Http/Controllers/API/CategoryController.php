<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
   public function show()
   {
        $cats = Category::all();
        $groups = Group::get()->take(5);
        $js_cats = new CategoryCollection($cats);
        $js_recent_groups = new CategoryCollection($groups);
        $data = ['categories' => $js_cats , 'groups'=>$js_recent_groups];

    if($cats == null & $groups == null )
    {
        return $this->SendError("Categoires and Resent Groups Not Found");
    }
    else
        return $this->SendResponse($data , "Categoires and Resent Groups Sent");
   }
}
