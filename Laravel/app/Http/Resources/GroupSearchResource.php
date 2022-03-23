<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupSearchResource extends JsonResource
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

        return [
            'data' => $this->collection,
            'id'                => $this->id,
            'name'              => $this->name,
            'description'       => $this->description,
            'category'          => $this->category,
            'tags'              => $this->tags,
            'images'            => public_path('uploads/Groups/').$this->image,
            'created_at'        => $this->created_at->format('d/m/Y'),
            'updated_at'        => $this->updated_at->format('d/m/Y')
        ];
    }
}
