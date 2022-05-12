<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FavGroupCollection extends ResourceCollection
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
                       'id'                =>$data->groups->id,
                       'name'              =>$data->groups->name,
                       'image'             => 'uploads/Groups/'.$data->groups->image,
                   ];
               })
       ];
    }
}
