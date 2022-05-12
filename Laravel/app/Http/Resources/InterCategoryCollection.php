<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InterCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            $this->collection->map(function($data) {

                return [
                       'id'                =>$data->id,
                       'name'              =>$data->name,
                       'image'             => 'uploads/Categories/'.$data->image,
                       'tags'             => new TagCollection($data->tags()->latest('updated_at')->take(3)->get()),
                       'groups'             =>  new GroupCollection($data->groups()->latest('updated_at')->take(3)->get()) ,
                   ];


               })
       ];
    }
}
