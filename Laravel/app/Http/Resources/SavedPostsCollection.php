<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SavedPostsCollection extends ResourceCollection
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
                       'id'                =>$data->post->id,
                       'title'              =>$data->post->title,
                       'image'             => 'uploads/Posts/'.$data->post->image,
                   ];
               })
       ];
    }
}
