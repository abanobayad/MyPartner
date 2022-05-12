<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        // return parent::toArray($request);

        $count = $this->needed_persons - $this->requests()->where('status' , 'accept')->count();
        // dd($this->requests()->where('status' , 'accept')->count());
        if($this->image ==null )
        {
            return [
                'id'                => $this->id,
                'user_id'           => $this->user_id,
                'group_id'          => $this->group_id,
                'title'             => $this->title,
                'content'           => $this->content,
                'location'          => $this->location,
                'counter'           => $count,
                'needed_persons'    => $this->needed_persons,
                'price'             => $this->price,
                'updated_at'        => $this->updated_at->diffForhumans()
            ];
        }
    else
        {
            return [
                'id'                => $this->id,
                'user_id'           => $this->user_id,
                'group_id'          => $this->group_id,
                'title'             => $this->title,
                'content'           => $this->content,
                'location'          => $this->location,
                'image'             => 'uploads/Posts/'.$this->image ,
                'counter'           => $count,
                'needed_persons'    => $this->needed_persons,
                'price'             => $this->price,
                'updated_at'        => $this->updated_at->diffForhumans()
            ];
        }

    }
}
