<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{

    public function get($id)
    {
        $tag = Tag::find($id);

        if ($tag == null) {
            return $this->SendError("Tag not found");
        }

        $tag = new TagResource($tag);
        $groups = $tag->groups()->get();
        $groups = new GroupCollection($groups);
        $data = ['Tag' => $tag , 'Groups' => $groups];

        return $this->SendResponse( $data , 'Tag sent successfully');

    }
}
