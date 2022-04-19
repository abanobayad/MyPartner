<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{

    public function toArray($request)
    {
        if ($this->image != null){
            return
            [
                'id' => $this->id,
                'content' => $this->content,
                'username'=> $this->user->name,
                'image' => public_path('uploads/Replies/').$this->image,
                'created_at' =>$this->created_at->diffForhumans()
            ];
        }
        else
        {
            return
            [
                'id' => $this->id,
                'username'=> $this->user->name,
                'content' => $this->content,
                'created_at' =>$this->created_at->diffForhumans()
            ];
        }    }
}
