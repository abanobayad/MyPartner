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
                'user_id'=> $this->user->id,
                'comment_id' => $this->comment_id,
                'image' => 'uploads/Replies/'.$this->image,
                'updated_at' =>$this->updated_at->diffForhumans(),

            ];
        }
        else
        {
            return
            [
                'id' => $this->id,
                'username'=> $this->user->name,
                'user_id'=> $this->user->id,
                'comment_id' => $this->comment_id,
                'content' => $this->content,
                'updated_at' =>$this->updated_at->diffForhumans(),
            ];
        }    }
}
