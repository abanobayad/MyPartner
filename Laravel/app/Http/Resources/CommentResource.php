<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        if ($this->image != null){
            return
            [
                'id' => $this->id,
                'content' => $this->content,
                'image' => 'uploads/Comments/'.$this->image,
                'created_at' =>$this->created_at->diffForhumans()

            ];
        }
        else
        {
            return
            [
                'id' => $this->id,
                'content' => $this->content,
                'created_at' =>$this->created_at->diffForhumans()
            ];
        }
    }
}
