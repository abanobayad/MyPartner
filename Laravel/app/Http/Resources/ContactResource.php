<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'Sender ' => $this->user()->select('id' , 'name')->get(),
            'subject ' => $this->subject,
            'content' => $this->content,
            'created_at' =>$this->created_at->diffForhumans()
        ];    }
}
