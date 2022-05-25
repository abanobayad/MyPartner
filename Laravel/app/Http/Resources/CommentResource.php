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
        $replies = $this->replies()->get();
        $js_replies = new RepliesCollection($replies);

        if ($this->image != null){

            if($replies->count() != 0)
            {
                return
                [
                    'comment_id' => $this->id,
                    'user_id' => $this->user()->first()->id,
                    'content' => $this->content,
                    'image' => 'uploads/Comments/'.$this->image,
                    'updated_at'        => $this->updated_at->diffForhumans(),
                    'replies' => $js_replies
                ];
            }
            else
            {
                return
                [
                    'comment_id' => $this->id,
                    'user_id' => $this->user()->first()->id,
                    'content' => $this->content,
                    'image' => 'uploads/Comments/'.$this->image,
                    'updated_at'        => $this->updated_at->diffForhumans(),
                ];
            }
        }
        else
        {
            if($replies->count() != 0)
            {
                return
                [
                    'comment_id' => $this->id,
                    'user_id' => $this->user()->first()->id,
                    'content' => $this->content,
                    'updated_at'        => $this->updated_at->diffForhumans(),
                    'replies' => $js_replies
                ];
            }
            else
            {
                return
                [
                    'comment_id' => $this->id,
                    'user_id' => $this->user()->first()->id,
                    'content' => $this->content,
                    'updated_at'        => $this->updated_at->diffForhumans(),
                ];
            }
        }
    }
}
