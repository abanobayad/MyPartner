<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'Sender ' => $this->sender()->select('id' , 'name')->get(),
            'receiver ' => $this->receiver()->select('id' , 'name')->get(),
            'body' => $this->body,
            'attachment ' => $this->attachment,
            'seen' => $this->seen,
            'created_at' =>$this->created_at->diffForhumans()
        ];
    }
}
