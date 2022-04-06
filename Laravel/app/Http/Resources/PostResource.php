<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        // return parent::toArray($request);


        return [
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'group_id'          => $this->group_id,
            'title'             => $this->title,
            'content'           => $this->content,
            'location'          => $this->location,
            'image'             => public_path('uploads/Posts/').$this->image ,
            'needed_persons'    => $this->needed_persons,
            'price'             => $this->price,
            'created_at'        => $this->created_at->format('d/m/Y'),
            'updated_at'        => $this->updated_at->format('d/m/Y')
        ];
    }
}
