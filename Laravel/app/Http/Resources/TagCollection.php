<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
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
                    'category'          =>$data->category->name,
                    'image'             =>'uploads/Tags/'.$data->image,
                    'updated_at'        =>$data->updated_at->diffForhumans(),
                ];
            })
    ];
    }
}
