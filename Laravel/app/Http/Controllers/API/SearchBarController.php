<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\GroupSearchResource;
class SearchBarController extends BaseController
{
    public function GroupSearch(Request $request)
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
        // dd($groups->get());

        $data =$groups->get();
        foreach ($data as $d) {
            $d->image =  public_path('uploads/Groups/') . $d->image;
        }
        // $js = new GroupSearchResource($data);
        return $this->SendResponse($data, "Search Result Sent");

    }
}
