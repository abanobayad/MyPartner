<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatCollection extends ResourceCollection
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
            $this->collection->map(function($data) {

                return [
                    'id' => $data->id,
                    'Sender ' => $data->sender()->select('id' , 'name')->get(),
                    'receiver ' => $data->receiver()->select('id' , 'name')->get(),
                    'body' => $data->body,
                    'attachment ' => $data->attachment,
                    'seen' => $data->seen,
                    'updated_at' =>$data->updated_at->diffForhumans()
                ];

               })
       ];
    }
}
