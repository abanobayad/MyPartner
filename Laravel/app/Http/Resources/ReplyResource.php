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
                'user name'=> $this->user->name,
                'image' => public_path('uploads/replies/').$this->image,

            ];
        }
        else
        {
            return
            [
                'id' => $this->id,
                'user name'=> $this->user->name,
                'content' => $this->content,
            ];
        }    }
}
