<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
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
                        'user_id'           => $data->user_id,
                        'group_id'          => $data->group_id,
                        'title'             => $data->title,
                        'content'           => $data->content,
                        'location'          => $data->location,
                        'image'             => public_path('uploads/Posts/').$data->image ,
                        'needed_persons'    => $data->needed_persons,
                        'price'             => $data->price,
                        'updated_at'        => $data->updated_at->diffForhumans()
                ];})];


    }
}
