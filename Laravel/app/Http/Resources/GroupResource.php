<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->image ==null)
        {
            return [
                'id'                => $this->id,
                'name'              =>$this->name,
                'description'       =>$this->description,
                'updated_at'        =>$this->updated_at->diffForhumans(),
            ];
        }
        else
        {
            return [
                'id'                => $this->id,
                'name'              =>$this->name,
                'description'       =>$this->description,
                'image'             => public_path('uploads/Groups/').$this->image,
                'updated_at'        =>$this->updated_at->diffForhumans(),
            ];
        }
    }
}
