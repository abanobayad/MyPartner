<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request)
    {

        // return parent::toArray($request);

   return
        [
            'user_id' => $this->user_id ,
            'name' => $this->user()->first()->name,
            'image' => public_path('uploads/Users/').$this->image ,
            'address' =>$this->address ,
            'bio' =>$this->bio ,
            'phone' =>$this->phone ,
            'gender' =>$this->gender ,
            'updated_at' =>$this->updated_at->diffForhumans()

        ];
    }
}
