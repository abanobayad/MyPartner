<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RepliesCollection extends ResourceCollection
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
            $this->collection->map(function ($data) {

                if($data->image != null){
                    return [
                        'reply_id'                => $data->id,
                        'user_id'                => $data->user()->first()->id,
                        'content'           => $data->content,
                        'image'             => 'uploads/Replies/'.$data->image,
                        'updated_at'        => $data->updated_at->diffForhumans()
                    ];
                }
                else
                {
                    return [
                        'reply_id'                => $data->id,
                        'user_id'                => $data->user()->first()->id,
                        'content'           => $data->content,
                        'updated_at'        => $data->updated_at->diffForhumans()
                    ];
                }
            })
        ];
    }
}
