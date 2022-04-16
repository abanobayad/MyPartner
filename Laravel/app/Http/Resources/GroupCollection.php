<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCollection extends ResourceCollection
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
                    'id'                => $data->id,
                    'name'              =>$data->name,
                    'description'       =>$data->description,
                    'image'             => public_path('uploads/Groups/').$data->image,
                    'created_at'        =>$data->created_at->format('d/m/Y'),
                    'updated_at'        =>$data->updated_at->diffForhumans(),
                ];
            })
    ];
    }
}
