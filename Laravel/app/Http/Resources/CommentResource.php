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
                'image' => public_path('uploads/Comments/').$this->image,

            ];
        }
        else
        {
            return
            [
                'id' => $this->id,
                'content' => $this->content,
            ];
        }
    }
}
