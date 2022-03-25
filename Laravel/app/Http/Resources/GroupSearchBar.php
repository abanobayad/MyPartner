<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupSearchBar extends ResourceCollection
{

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}







// 'id'                =>$this->collection->id,
// 'name'              =>$this->collection->name,
// 'description'       =>$this->collection->description,
// 'category'          =>$this->collection->category,
// 'tags'              =>$this->collection->tags,
// 'images'            => public_path('uploads/Groups/').$this->image,
// 'created_at'        =>$this->collection->created_at->format('d/m/Y'),
// 'updated_at'        =>$this->collection->updated_at->format('d/m/Y')
